<?php

namespace App\Http\Services;

use App\Http\Requests\MemberPointRequest;
use App\Models\LedgerPoint;
use App\Models\MemberPoint;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MemberPointServices
{
    public function showMemberPointDetail($id)
    {
        $member = MemberPoint::findOrFail($id);

        return $member;
    }

    private function checkUserId($id)
    {
        $isExist = User::findOrFail($id);
        return $isExist;
    }

    private function checkStoreId($id)
    {
        $isExist = Store::findOrFail($id);
        return $isExist;
    }

    private function insertIntoMemberPoint(MemberPointRequest $request)
    {
        $member_point = $request->all();
        $member_point['employee_id'] = $request->user()->id;
        $data = MemberPoint::create($member_point);
        $res['user_id'] = $data->user_id;
        $res['type'] = 'top up';
        $res['ref_id'] = $data->id;
        $res['add'] = $data->point;
        return $res;
    }

    public function getLastPointById($id)
    {
        $data = LedgerPoint::getLastPoint($id)->first();
        $res['current'] = is_null($data) ? 0 : $data->final;

        return $res;
    }

    private function insertIntoLadgerPoint($data)
    {
        LedgerPoint::create($data);
    }

    public function storeNewMemberPoint(MemberPointRequest $request)
    {
        DB::beginTransaction();
        $this->checkUserId($request->user_id);
        $this->checkStoreId($request->store_id);
        $dataLastPoint = $this->getLastPointById($request->user_id);
        $dataInsertPoint = $this->insertIntoMemberPoint($request);
        $dataInsertPoint['final'] = $dataInsertPoint['add'] + $dataLastPoint['current'];
        $data = array_merge($dataLastPoint, $dataInsertPoint);
        $this->insertIntoLadgerPoint($data);
        DB::commit();
    }
}
