<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeachersRegistration extends Controller
{

    public function getTeacherDetails()
    {
        $teacherDetails = Teacher::find(Auth::guard('teacher')->id());
        return response()->json($teacherDetails);
    }

    public function saveProfileImage(Request $request)
    {
        if ($request->hasFile('profileImage')) {
            $authUser = Teacher::find(Auth::guard('teacher')->id());

            $file = $request->file('profileImage');
            $fileName = time() . $file->getClientOriginalName();
            $path = 'teacher/images/';
            $file->storeAs($path, $fileName, 'public');

            $authUser->teacher_image = $fileName;
            $worked = $authUser->update();
            if ($worked) {
                return response()->json('worked');
            } else {
                return response()->json('failed');
            }
        }
    }

    public function deleteTeacherProfilePicture()
    {
        $teacherDetails = Teacher::find(Auth::guard('teacher')->id());
        unlink(public_path('storage/teacher/images/' . $teacherDetails->teacher_image));
        $teacherDetails->update(['teacher_image' => null]);
    }

    public function uploadIntroVideo(Request $request)
    {
        $request->validate([
            'intro_video' => 'required|file|mimes: m4v,avi,flv,mp4,mov|max: 120000'
        ]);

        $teacherDetails = Teacher::find(Auth::guard('teacher')->id());
        if ($teacherDetails->intro_video_url) {
            unlink(public_path('storage/teacher/videos/' . $teacherDetails->intro_video_url));
        }
        $file = $request->file('intro_video');
        $fileName = $file->hashName();
        $path = 'teacher/videos/';
        $saveIntroVideo =  $file->storeAs($path, $fileName, 'public');
        if ($saveIntroVideo) {
            Teacher::where('id', Auth::guard('teacher')->id())
                ->update([
                    'intro_video_url' => $fileName
                ]);
        }
    }
    public function saveTeacherAvailability(Request $request)
    {
        $timeSlotsDetails = TimeSlot::where('teacher_id', Auth::guard('teacher')->id())
            ->where('week_day', $request->week_day)->first();
        if ($timeSlotsDetails) {
            TimeSlot::where('teacher_id', Auth::guard('teacher')->id())
                ->where('week_day', $request->week_day)->update([
                    'teacher_timezone' => $request->user_timezone,
                    'slot1' => $request->slot_1,
                    'slot2' => $request->slot_2,
                    'slot3' => $request->slot_3,
                    'slot4' => $request->slot_4,
                    'slot5' => $request->slot_5,
                    'slot6' => $request->slot_6,
                    'slot7' => $request->slot_7,
                    'slot8' => $request->slot_8,
                    'slot9' => $request->slot_9,
                    'slot10' => $request->slot_10,
                    'slot11' => $request->slot_11,
                    'slot12' => $request->slot_12,
                    'slot13' => $request->slot_13,
                    'slot14' => $request->slot_14,
                    'slot15' => $request->slot_15,
                    'slot16' => $request->slot_16,
                    'slot17' => $request->slot_17,
                    'slot18' => $request->slot_18,
                    'slot19' => $request->slot_19,
                    'slot20' => $request->slot_20,
                    'slot21' => $request->slot_21,
                    'slot22' => $request->slot_22,
                    'slot23' => $request->slot_23,
                    'slot24' => $request->slot_24
                ]);
        } else {
            $timeSlots = new TimeSlot;
            $timeSlots->teacher_id = Auth::guard('teacher')->id();
            $timeSlots->week_day = $request->week_day;
            $timeSlots->teacher_timezone = $request->user_timezone;
            $timeSlots->slot1 = $request->slot_1;
            $timeSlots->slot2 = $request->slot_2;
            $timeSlots->slot3 = $request->slot_3;
            $timeSlots->slot4 = $request->slot_4;
            $timeSlots->slot5 = $request->slot_5;
            $timeSlots->slot6 = $request->slot_6;
            $timeSlots->slot7 = $request->slot_7;
            $timeSlots->slot8 = $request->slot_8;
            $timeSlots->slot9 = $request->slot_9;
            $timeSlots->slot10 = $request->slot_10;
            $timeSlots->slot11 = $request->slot_11;
            $timeSlots->slot12 = $request->slot_12;
            $timeSlots->slot13 = $request->slot_13;
            $timeSlots->slot14 = $request->slot_14;
            $timeSlots->slot15 = $request->slot_15;
            $timeSlots->slot16 = $request->slot_16;
            $timeSlots->slot17 = $request->slot_17;
            $timeSlots->slot18 = $request->slot_18;
            $timeSlots->slot19 = $request->slot_19;
            $timeSlots->slot20 = $request->slot_20;
            $timeSlots->slot21 = $request->slot_21;
            $timeSlots->slot22 = $request->slot_22;
            $timeSlots->slot23 = $request->slot_23;
            $timeSlots->slot24 = $request->slot_24;
            $timeSlots->save();

            if ($timeSlots) {
                return response()->json('Records saved');
            } else {
                return response()->json('Records not inserted');
            }
        }
    }
    public function saveTeacherDescription(Request $request)
    {

        switch ($request->extra_language) {
            case ('Two'):
                $teacherDescription = $request->validate([
                    'nationality' => ['required', 'string'],
                    'teacher_name' => ['required', 'string'],
                    'first_language' => ['required', 'string'],
                    'first_language_proficiency' => ['required', 'string'],
                    'second_language' => ['required', 'string'],
                    'second_language_proficiency' => ['required', 'string'],
                    'third_language' => ['required', 'string'],
                    'third_language_proficiency' => ['required', 'string'],
                    'personal_description' => ['required', 'string', 'min:100', 'max:1000'],
                    'hourly_pay' => ['required', 'numeric', 'gt:3', 'lt:250']
                ]);

                $updateTeacherDetails = Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'nationality' => $request->nationality,
                        'name' => $request->teacher_name,
                        'nationality_flag' => $request->flag,
                        'first_language' => $request->first_language,
                        'first_language_proficiency' => $request->first_language_proficiency,
                        'second_language' => $request->second_language,
                        'second_language_proficiency' => $request->second_language_proficiency,
                        'third_language' => $request->third_language,
                        'third_language_proficiency' => $request->third_language_proficiency,
                        'description' => $request->personal_description,
                        'hourly_pay' => $request->hourly_pay,
                    ]);

                break;
            case ('One'):
                $teacherDescription = $request->validate([
                    'nationality' => ['required', 'string'],
                    'teacher_name' => ['required', 'string'],
                    'first_language' => ['required', 'string'],
                    'first_language_proficiency' => ['required', 'string'],
                    'second_language' => ['required', 'string'],
                    'second_language_proficiency' => ['required', 'string'],
                    'personal_description' => ['required', 'string', 'min:100', 'max:1000'],
                    'hourly_pay' => ['required', 'numeric', 'gt:3', 'lt:250']
                ]);

                $updateTeacherDetails = Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'nationality' => $request->nationality,
                        'nationality_flag' => $request->flag,
                        'name' => $request->teacher_name,
                        'first_language' => $request->first_language,
                        'first_language_proficiency' => $request->first_language_proficiency,
                        'second_language' => $request->second_language,
                        'second_language_proficiency' => $request->second_language_proficiency,
                        'description' => $request->personal_description,
                        'hourly_pay' => $request->hourly_pay,
                    ]);

                break;
            case (''):
                $teacherDescription = $request->validate([
                    'nationality' => ['required', 'string'],
                    'teacher_name' => ['required', 'string'],
                    'first_language' => ['required', 'string'],
                    'first_language_proficiency' => ['required', 'string'],
                    'personal_description' => ['required', 'string', 'min:100', 'max:1000'],
                    'hourly_pay' => ['required', 'numeric', 'gt:3', 'lt:250']
                ]);
                $updateTeacherDetails = Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'nationality' => $request->nationality,
                        'nationality_flag' => $request->flag,
                        'name' => $request->teacher_name,
                        'first_language' => $request->first_language,
                        'first_language_proficiency' => $request->first_language_proficiency,
                        'description' => $request->personal_description,
                        'hourly_pay' => $request->hourly_pay,
                    ]);

                break;
        }
    }

    public function saveTeacherQualification(Request $request)
    {
        switch ($request->has_docs) {
            case ('teach_lang'):
                $request->validate([
                    'teaching_certificate_doc' => ['required', 'file', 'max: 15000'],
                    'teaching_certificate_year' => ['required', 'date'],
                    'lang_certificate_year' => ['required', 'date'],
                    'lang_certificate_doc' => ['required', 'file', 'max: 15000']
                ]);
                $file = $request->file('teaching_certificate_doc');
                $teachingCertificate = $file->hashName();
                $path = 'teacher/images/';
                $file->storeAs($path, $teachingCertificate, 'public');
                $file = $request->file('lang_certificate_doc');
                $langCertificate = $file->hashName();
                $path = 'teacher/images/';
                $file->storeAs($path, $langCertificate, 'public');

                Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'lang_certificate_year' => $request->lang_certificate_year,
                        'lang_certificate_doc' => $langCertificate,
                        'teaching_certificate_year' => $request->teaching_certificate_year,
                        'teaching_certificate_doc' => $teachingCertificate,
                        'has_teaching_certificate' => 1,
                        'has_lang_certificate' => 1
                    ]);
                break;
            case ('lang'):
                $request->validate([
                    'lang_certificate_year' => ['required', 'date'],
                    'lang_certificate_doc' => ['required', 'file', 'max: 15000']
                ]);


                $file = $request->file('lang_certificate_doc');
                $langCertificate = $file->hashName();
                $path = 'teacher/images/';
                $file->storeAs($path, $langCertificate, 'public');

                Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'lang_certificate_year' => $request->lang_certificate_year,
                        'lang_certificate_doc' => $langCertificate,
                        'has_lang_certificate' => 1
                    ]);
                break;
            case ('teach'):
                $request->validate([
                    'teaching_certificate_doc' => ['required', 'file', 'max: 15000'],
                    'teaching_certificate_year' => ['required', 'date'],
                ]);
                $file = $request->file('teaching_certificate_doc');
                $teachingCertificate = $file->hashName();
                $path = 'teacher/images/';
                $file->storeAs($path, $teachingCertificate, 'public');

                Teacher::where('id', Auth::guard('teacher')->id())
                    ->update([
                        'teaching_certificate_year' => $request->teaching_certificate_year,
                        'teaching_certificate_doc' => $teachingCertificate,
                        'has_teaching_certificate' => 1
                    ]);
                break;
        }
    }

    public function updateLangCertificate(Request $request)
    {
        $teacherDetails = Teacher::find(Auth::guard('teacher')->id());
        // Storage::delete('teacher/images/'.$teacherDetails->lang_certificate_doc);
        unlink(public_path('storage/teacher/images/' . $teacherDetails->lang_certificate_doc));
        $teacherDetails->update([
            'lang_certificate_doc' => null,
            'lang_certificate_year' => null,
            'has_lang_certificate' => 0
        ]);
    }
    public function updateTeachingCertificate(Request $request)
    {
        $teacherDetails =  Teacher::find(Auth::guard('teacher')->id());
        unlink(public_path('storage/teacher/images/' . $teacherDetails->teaching_certificate_doc));
        // Storage::delete('teacher/images/'.$teacherDetails->teaching_certificate_doc);
        $teacherDetails->update([
            'teaching_certificate_doc' => null,
            'teaching_certificate_year' => null,
            'has_teaching_certificate' => 0
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teachers',
            'password' => 'required|string|min:6|confirmed',
        ]);
        Teacher::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('teacher.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login');
    }
}
