<?php
namespace App\Services\Impl;

use App\Models\OpdList;
use App\Models\Rule;
use Illuminate\Support\Str;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoleServiceImpl implements RoleService
{
    public function getEmployeeHasAccess()
    {
        return User::withWhereHas('rules')->latest()->paginate(8);
    }
    private function getUserRole($rule)
    {
        return Auth::user()->rules->pluck('nama')->intersect($rule)->isNotEmpty();
    }
    public function getRuleType()
    {
        return Rule::where('nama', '!=', 'ADMIN')->latest()->get();
    }

    public function setRuleEmployee(Request $request)
    {
        $token = Str::uuid();
        $validated = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'rule_id' => 'required',
        ]);
        $user = User::where('nip', $validated['nip'])->first();
        if (!$user) {
            $user = User::create([
                'username' => $validated['username'],
                'name' => $validated['name'],
                'nip' => $validated['nip'],
                'jabatan' => $validated['jabatan'],
                'token' => $token,
            ]);
        } else {
            $user->update([
                'username' => $validated['username'],
                'name' => $validated['name'],
                'nip' => $validated['nip'],
                'jabatan' => $validated['jabatan'],
                'token' => $token,
            ]);
        }
        $rule = $user->rules->pluck('name')->isNotEmpty();
        if (!$rule) {
            $user->rules()->attach($validated['rule_id']);
            return redirect(route('admin.dashboard.user.manager'))->with('success', 'Rule berhasil ditambahkan ke user.');
        } else {
            return redirect(route('admin.dashboard.user.manager'))->with('error', 'User Sudah memeiliki Rule');
        }
    }

    public function adminCheck()
    {
        $accesRule = ['ADMIN', 'KABAG', 'VERIFIKATOR 2', 'VERIFIKATOR 1'];
        return $this->getUserRole($accesRule);
    }
    public function updateRuleEmployee(Request $request, $id)
    {
        $user = User::find($id);
        $validated = $request->validate([
            'rule' => 'required',
        ]);
        $rule = $user->rules->pluck('id');
        $user->rules()->detach($rule);
        $user->rules()->attach($validated['rule']);
    }
    public function deleteRuleEmployee($id)
    {
        $user = User::find($id);
        $rule = $user->rules->pluck('id');
        $user->rules()->detach($rule);
    }

    public function kamiPeduliUploader()
    {
        $accesRule = ['SEKRETARIS'];
        return $this->getUserRole($accesRule);
    }

    public function ecorrectionUploader()
    {
        $accesRule = ['KABID'];
        return $this->getUserRole($accesRule);
    }

    public function ecorrectionAdmin()
    {
        $accesRule = ['ADMIN', 'KABAG', 'VERIFIKATOR 2'];
        return $this->getUserRole($accesRule);
    }
    public function userManagerAdmin()
    {
        $accesRule = ['ADMIN', 'KABAG'];
        return $this->getUserRole($accesRule);
    }

    public function getOpdEmployee()
    {
        return OpdList::all();
    }

    public function checkVerifikatorTwo()
    {
        $accesRule = ['VERIFIKATOR 2'];
        return $this->getUserRole($accesRule);
    }

    public function checkVerifikatorOne()
    {
        $accesRule = ['VERIFIKATOR 1'];
        return $this->getUserRole($accesRule);
    }

    public function getVerifikatorTwo()
    {
        return User::with('rules')
            ->whereHas('rules', function ($query) {
                $query->where('nama', '=', 'VERIFIKATOR 2');
            })
            ->get();
    }

    public function getVerifikatorOne()
    {
        return User::with('rules')
            ->whereHas('rules', function ($query) {
                $query->where('nama', '=', 'VERIFIKATOR 1');
            })
            ->get();
    }

    public function disposisiAccess()
    {
        $accesRule = ['KABAG', 'ADMIN'];
        return $this->getUserRole($accesRule);
    }
}
