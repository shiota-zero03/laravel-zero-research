<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public function getData()
    {
        return Setting::get()->first();
    }
    public function saveData(array $data, $id)
    {
        return Setting::findOrFail($id)->update($data);
    }
}
