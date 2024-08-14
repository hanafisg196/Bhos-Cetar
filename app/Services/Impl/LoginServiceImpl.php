<?php

namespace App\Services\Impl;

use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginServiceImpl implements LoginService
{
    public function Login(Request $request)
    {

        $username = $request->input('username');
        $password = $request->input('password');



        $response  = Http::asMultipart()->withHeaders([
            "apiKey" => "eyJ4NXQiOiJOVGRtWmpNNFpEazNOalkwWXpjNU1tWm1PRGd3TVRFM01XWXdOREU1TVdSbFpEZzROemM0WkE9PSIsImtpZCI6ImdhdGV3YXlfY2VydGlmaWNhdGVfYWxpYXMiLCJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXJAY2FyYm9uLnN1cGVyIiwiYXBwbGljYXRpb24iOnsib3duZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ0aWVyUXVvdGFUeXBlIjpudWxsLCJ0aWVyIjoiVW5saW1pdGVkIiwibmFtZSI6IkthYnVwYXRlbiBUYW5haCBEYXRhciIsImlkIjoyMDg1LCJ1dWlkIjoiNGE5N2Y1YmItODEyNy00NDMzLTg2MjItNjZlNTcxYTM0OWViIn0sImlzcyI6Imh0dHBzOlwvXC9zcGxwLmxheWFuYW4uZ28uaWQ6NDQzXC9vYXV0aDJcL3Rva2VuIiwidGllckluZm8iOnsiQnJvbnplIjp7InRpZXJRdW90YVR5cGUiOiJyZXF1ZXN0Q291bnQiLCJncmFwaFFMTWF4Q29tcGxleGl0eSI6MCwiZ3JhcGhRTE1heERlcHRoIjowLCJzdG9wT25RdW90YVJlYWNoIjp0cnVlLCJzcGlrZUFycmVzdExpbWl0IjowLCJzcGlrZUFycmVzdFVuaXQiOm51bGx9LCJVbmxpbWl0ZWQiOnsidGllclF1b3RhVHlwZSI6InJlcXVlc3RDb3VudCIsImdyYXBoUUxNYXhDb21wbGV4aXR5IjowLCJncmFwaFFMTWF4RGVwdGgiOjAsInN0b3BPblF1b3RhUmVhY2giOmZhbHNlLCJzcGlrZUFycmVzdExpbWl0IjoxMDAwMDAsInNwaWtlQXJyZXN0VW5pdCI6InNlYyJ9fSwia2V5dHlwZSI6IlBST0RVQ1RJT04iLCJwZXJtaXR0ZWRSZWZlcmVyIjoiIiwic3Vic2NyaWJlZEFQSXMiOlt7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiU0tNLVRhbmFoLURhdGFyIiwiY29udGV4dCI6Ilwvc2ttLXRhbmFoLWRhdGFyXC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ2ZXJzaW9uIjoiMS4wIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJkaXBfdGVyYmFydSIsImNvbnRleHQiOiJcL2RpcF90ZXJiYXJ1XC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ2ZXJzaW9uIjoiMS4wIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJiZXJpdGFfdGFuYWhkYXRhcl90ZXJiYXJ1IiwiY29udGV4dCI6IlwvYmVyaXRhX3RhbmFoZGF0YXJfdGVyYmFydVwvMS4wIiwicHVibGlzaGVyIjoiZGlza29taW5mb190YW5haGRhdGFyIiwidmVyc2lvbiI6IjEuMCIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoid2lzYXRhIiwiY29udGV4dCI6Ilwvd2lzYXRhXC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ2ZXJzaW9uIjoiMS4wIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJLZXVhbmdhbk5hZ2FyaSIsImNvbnRleHQiOiJcL2tldWFuZ2FuLW5hZ2FyaVwvMS4wIiwicHVibGlzaGVyIjoiZGlza29taW5mb190YW5haGRhdGFyIiwidmVyc2lvbiI6IjEuMCIsInN1YnNjcmlwdGlvblRpZXIiOiJCcm9uemUifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiRGF0YVB1c2RhdGluU01QMjAyMyIsImNvbnRleHQiOiJcL2RhdGEtcHVzZGF0aW4tc21wLTIwMjNcLzEuMCIsInB1Ymxpc2hlciI6ImRpc2tvbWluZm9fdGFuYWhkYXRhciIsInZlcnNpb24iOiIxLjAiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6IktFUEVHQVdBSUFOIiwiY29udGV4dCI6Ilwva2VwZWdhd2FpYW5cLzEuMCIsInB1Ymxpc2hlciI6ImRpc2tvbWluZm9fdGFuYWhkYXRhciIsInZlcnNpb24iOiIxLjAiLCJzdWJzY3JpcHRpb25UaWVyIjoiVW5saW1pdGVkIn0seyJzdWJzY3JpYmVyVGVuYW50RG9tYWluIjoiY2FyYm9uLnN1cGVyIiwibmFtZSI6IkluZm9ybWFzaS1QdWJsaWsiLCJjb250ZXh0IjoiXC9pbmZvcm1hc2ktcHVibGlrXC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ2ZXJzaW9uIjoiMS4wIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJjdXRpIiwiY29udGV4dCI6IlwvY3V0aVwvMS4wIiwicHVibGlzaGVyIjoiZGlza29taW5mb190YW5haGRhdGFyIiwidmVyc2lvbiI6IjEuMCIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifSx7InN1YnNjcmliZXJUZW5hbnREb21haW4iOiJjYXJib24uc3VwZXIiLCJuYW1lIjoiU0lQRURBTCIsImNvbnRleHQiOiJcL3NpcGVkYWxcL3YxIiwicHVibGlzaGVyIjoiZGlza29taW5mb190YW5haGRhdGFyIiwidmVyc2lvbiI6InYxIiwic3Vic2NyaXB0aW9uVGllciI6IlVubGltaXRlZCJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJIYXJnYS1Lb21vZGl0aSIsImNvbnRleHQiOiJcL2hhcmdhLWtvbW9kaXRpXC8xLjAiLCJwdWJsaXNoZXIiOiJkaXNrb21pbmZvX3RhbmFoZGF0YXIiLCJ2ZXJzaW9uIjoiMS4wIiwic3Vic2NyaXB0aW9uVGllciI6IkJyb256ZSJ9LHsic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJNYWxQZWxheWFuYW5QdWJsaWsiLCJjb250ZXh0IjoiXC9tYWwtcGVsYXlhbmFuLXB1Ymxpa1wvMS4wIiwicHVibGlzaGVyIjoiZGlza29taW5mb190YW5haGRhdGFyIiwidmVyc2lvbiI6IjEuMCIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifV0sInRva2VuX3R5cGUiOiJhcGlLZXkiLCJwZXJtaXR0ZWRJUCI6IiIsImlhdCI6MTcyMjk5NzkyNSwianRpIjoiN2Q3ZTJjMTktYTkwNi00ZTY3LTlkN2MtNTM1OGFmOWU0OTYwIn0=.rJhxyPU9_SA7oP707eB4iiWny-Q1M7Yd75vmUjrsTUer9xk6ZLJTTNOJuuQWb3By7HWQC7wVVxKxlmTnz1WaHyJ4GoQEiM-SCaZ-ymv6V-qQ2393Vbs0OlwXa0zSpLZ2e3sepSkStfPGfVALAlEzba3KXzdsgWc3Hxj2AlTYsrGrh1XP7V9o1MY8kvkIQtuThZe6PKA-CVEKytJ6rkdNt6CDtIG49M8pnKU46geWZOkf184QjEjaA6XjKM7toifYtpdXmxeUGUEyi_i6KTe5sa7_LnCqzmBoYAQvt13x59uohJvtmDW2690CtfB4bqPrtk3ydGMpeo64pt-Nte3JHw=="
        ])->post("https://api-splp.layanan.go.id:443/kepegawaian/1.0/login-api", [

            'login' => $username,
            'password' => $password

        ]);

        $credent = $request->only('username', 'password');
        $credentials = $response->json();

        if ($credentials['error'] == false) {
            $request->session()->put('user', $credentials['data']);
            return redirect()->route('dashboard');
        } else {
            $credent = $request->only('username', 'password');
            if (Auth::attempt($credent)) {
                if (Auth::user()->role == 1) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return back()->with('error', $response->json('pesan'));
                }
            } else {

                return back()->with('error', $response->json('pesan'));
            }
        }
    }

    public function Logout(Request $request)
    {
       return $request->session()->forget('user');
    }

    public function LogoutAdmin()
    {
      Auth::logout();
      return redirect()->route('login');
    }
}
