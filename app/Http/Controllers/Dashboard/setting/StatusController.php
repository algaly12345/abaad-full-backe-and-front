<?php

namespace App\Http\Controllers\Dashboard\setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function changeStatus(User $user)
    {
        if ($user->is_active == 'disactive') {
            $user->is_active = 'active';
        } else {
            $user->is_active = 'disactive';
        }

        $user->save();

        toastr()->success('بنجاح', 'تم تغير الحالة');

        return back();
    }

    public function changeZoneStatus()
    {
    }
}
