@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">

</head>

<body>

    <div class="sidebar">
        <div class="logo-box">
            <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" alt="Logo">
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard') }}"
                class="nav-link {{ (($section ?? '') == 'dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> لوحة التحكم
            </a>
            <a href="{{ route('camps.index') }}"
                class="nav-link {{ (($section ?? '') == 'camps') ? 'active' : '' }}">
                <i class="bi bi-houses"></i> المخيمات
            </a>
            <a href="{{ route('requests.index') }}" class="nav-link {{ (($section ?? '') == 'requests') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> الطلبات
            </a>
            <div class="nav-link" onclick="showPage('reports', this)"><i class="bi bi-file-earmark-bar-graph"></i>
                التقارير</div>
            <div class="nav-link" onclick="showPage('institutionsSection', this)"><i class="bi bi-building"></i>
                المؤسسات</div>
            <div class="nav-link" onclick="showPage('users', this)"><i class="bi bi-person-check"></i> المستخدمين</div>
            <div class="nav-link" onclick="showPage('contact', this)"><i class="bi bi-people"></i> التواصل</div>
            <a href="{{ route('messages.index') }}"
                class="nav-link {{ (($section ?? '') == 'messages' || ($section ?? '') == 'message-details') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i> الرسائل
            </a>
        </nav>
    </div>


    <div class="main-wrapper">

        <div class="top-bar">
            <div class="user-name small fw-bold">محمد سلمان : مدخل بيانات</div>
            <div class="d-flex align-items-center">

                <a href="{{ route('home') }}" class="logout-link small">تسجيل الخروج</a>
                <i class="fa-solid fa-gear text-muted" style="cursor:pointer"></i>
            </div>
        </div>


        <div class="content-body">

            <div id="dashboard" class="page-section {{ (($section ?? '') == 'dashboard') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">لوحة التحكم</h4>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $campsCount ?? 0 }}</h3>
                            <p>مخيم</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $adminsCount ?? 0 }}</h3>
                            <p>مشرفين</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $representativesCount ?? 0 }}</h3>
                            <p>الممثلين</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $dataEntriesCount ?? 0 }}</h3>
                            <p>إدخال بيانات</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $supportersCount ?? 0 }}</h3>
                            <p>المؤسسات</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $messagesCount ?? 0 }}</h3>
                            <p>الرسائل</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="camps" class="page-section {{ (($section ?? '') == 'camps') ? 'active' : '' }}">
                <h4 class="text-center mb-4 fw-bold">المخيمات</h4>
                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المخيم</th>
                                <th>العنوان</th>
                                <th>المحافظة</th>
                                <th>عدد العائلات</th>
                                <th>الحالة</th>
                                <th>العملية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($camps as $camp)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $camp->name }}</td>
                                <td>{{ $camp->location }}</td>
                                <td>{{ $camp->governorate }}</td>
                                <td>{{ $camp->families_count }}</td>
                                <td>{{ $camp->status }}</td>
                                <td>
                                    <a href="{{ route('camps.show', $camp->id) }}">
                                        <i class="bi bi-eye text-primary mx-1" style="cursor:pointer"></i>
                                    </a>

                                    <a href="{{ route('camps.edit', $camp->id) }}">
                                        <i class="bi bi-pencil-square text-secondary mx-1" style="cursor:pointer"></i>
                                    </a>

                                    <i class="bi bi-shield-lock text-dark mx-1" style="cursor:pointer"
                                        data-bs-toggle="modal" data-bs-target="#authModal"></i>

                                    <i class="bi bi-bar-chart text-info mx-1" style="cursor:pointer"
                                        onclick="showPage('delegate-form')"></i>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">لا توجد مخيمات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="camp-info" class="page-section {{ (($subsection ?? '') == 'show-camp') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">معلومات المخيم</h4>
                @if(isset($selectedCamp))
                <div class="mx-auto" style="max-width: 600px;">
                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>اسم المخيم</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom" value="{{ $selectedCamp->name }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>العنوان</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom" value="{{ $selectedCamp->location }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>المحافظة</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom" value="{{ $selectedCamp->governorate }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>عدد العائلات</label></div>
                        <div class="col-9">
                            <input type="number" class="form-control form-control-custom" value="{{ $selectedCamp->families_count }}" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-3 text-start"><label>الحالة</label></div>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-custom" value="{{ $selectedCamp->status }}" readonly>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('camps.index') }}" class="btn btn-save">رجوع</a>
                    </div>
                </div>
                @endif
            </div>

            <div id="delegate-form" class="page-section {{ (($subsection ?? '') == 'edit-camp') ? 'active' : '' }}">
                <h4 class="text-center mb-5 fw-bold">تعديل المخيم</h4>
                @if(isset($selectedCamp))
                <form action="{{ route('camps.update', $selectedCamp->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mx-auto" style="max-width: 800px;">
                        <div class="col-md-6">
                            <label class="mb-2">اسم المخيم</label>
                            <input type="text" name="name" class="form-control form-control-custom" value="{{ $selectedCamp->name }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">المحافظة</label>
                            <input type="text" name="governorate" class="form-control form-control-custom" value="{{ $selectedCamp->governorate }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">العنوان</label>
                            <input type="text" name="location" class="form-control form-control-custom" value="{{ $selectedCamp->location }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">عدد العائلات</label>
                            <input type="number" name="families_count" class="form-control form-control-custom" value="{{ $selectedCamp->families_count }}">
                        </div>

                        <div class="col-md-6">
                            <label class="mb-2">الحالة</label>
                            <select name="status" class="form-select form-control-custom">
                                <option value="active" {{ $selectedCamp->status == 'active' ? 'selected' : '' }}>active</option>
                                <option value="inactive" {{ $selectedCamp->status == 'inactive' ? 'selected' : '' }}>inactive</option>
                            </select>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-save w-50 m-auto">حفظ</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>

            <div id="delegate-upload" class="page-section">


                <div class="form-container">
                    <h4 class="form-title">تسجيل بيانات مندوب المخيم</h4>

                    <form id="registrationForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>الاسم</label>
                                    <input type="text" class="form-control" placeholder="أدخل الاسم">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>الجنس</label>
                                    <select class="form-select">
                                        <option selected disabled>اختر</option>
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>ارفاق الهوية</label>
                                    <div class="file-input-wrapper">
                                        <input type="file" class="file-input-real">
                                        <div class="file-display">
                                            <i class="bi bi-paperclip"></i>
                                            <span class="file-name text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>رقم الهوية</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>الهاتف</label>
                                    <div class="input-group">

                                        <input type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>البريد الالكتروني</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group-custom">
                                    <label>ارفاق صورة شخصية</label>
                                    <div class="file-input-wrapper">
                                        <input type="file" class="file-input-real">
                                        <div class="file-display">
                                            <i class="bi bi-paperclip"></i>
                                            <span class="file-name text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label>ارفاق ورقة الاعتماد</label>
                                    <div class="file-input-wrapper">
                                        <input type="file" class="file-input-real">
                                        <div class="file-display">
                                            <i class="bi bi-paperclip"></i>
                                            <span class="file-name text-muted"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-save">حفظ</button>
                    </form>
                </div>


            </div>

            <div id="requests" class="page-section {{ (($section ?? '') == 'requests' && ($subsection ?? '') != 'show-request') ? 'active' : '' }}">
                <h4 class="text-center mb-4 fw-bold">طلبات الانضمام</h4>
                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المخيم</th>
                                <th>اسم مندوب المخيم</th>
                                <th>تاريخ الطلب</th>
                                <th>العملية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->camp_name }}</td>
                                <td>{{ $request->rep_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('requests.show', $request->id) }}">
                                        <i class="bi bi-eye text-primary fs-5" style="cursor:pointer"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">لا توجد طلبات</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="delegate1-form" class="page-section {{ (($subsection ?? '') == 'show-request') ? 'active' : '' }}">
                @if(isset($selectedRequest))
                <div id="request" class="page">
                    <div class="card-box">
                        <h3 class="text-center mb-4">تفاصيل الطلب</h3>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>اسم المخيم</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->camp_name }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>العنوان</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->location }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>المحافظة</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->governorate }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>عدد العائلات</label>
                                <input type="number" class="form-control" value="{{ $selectedRequest->families_count }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div>
                                <h4>مقدم المعلومات</h4>
                            </div>

                            <div class="col-md-6">
                                <label>الاسم</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->rep_name }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>الجنس</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->gender }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>الهاتف</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->phone }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>رقم الهوية</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->national_id_no }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>البريد الإلكتروني</label>
                                <input type="email" class="form-control" value="{{ $selectedRequest->email }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-md-6">
                                <label>الحالة</label>
                                <input type="text" class="form-control" value="{{ $selectedRequest->status }}" readonly
                                    style="border-radius: 19px; margin-top: 10px;">
                            </div>

                            <div class="col-12 text-start mt-4">
                                @if($selectedRequest->verification_img_path)
                                <p><strong>ملف التحقق:</strong> {{ $selectedRequest->verification_img_path }}</p>
                                @endif

                                @if($selectedRequest->national_id_img_path)
                                <p><strong>صورة الهوية:</strong> {{ $selectedRequest->national_id_img_path }}</p>
                                @endif

                                @if($selectedRequest->personal_img_path)
                                <p><strong>الصورة الشخصية:</strong> {{ $selectedRequest->personal_img_path }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="text-center mt-4 d-flex justify-content-center gap-2 flex-wrap">
                            @if($selectedRequest->status == 'pending')
                            <form method="POST" action="{{ route('requests.reject', $selectedRequest->id) }}">
                                @csrf
                                <button type="submit" class="btn rounded-pill px-5 me-2"
                                    style="border-radius: 19px; margin-top: 10px; background-color: #3a2d87; padding: 5px 10px; color: white;">
                                    رفض
                                </button>
                            </form>

                            <form method="POST" action="{{ route('requests.approve', $selectedRequest->id) }}">
                                @csrf
                                <button type="submit" class="btn rounded-pill px-5 me-2"
                                    style="border-radius: 19px; margin-top: 10px; background-color: #3a2d87; padding: 5px 10px; color: white;">
                                    قبول
                                </button>
                            </form>
                            @endif

                            <a href="{{ route('requests.index') }}" class="btn rounded-pill px-5 me-2"
                                style="border-radius: 19px; margin-top: 10px; background-color: #ddd; padding: 5px 10px; color: black;">
                                رجوع
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div id="institutionsSection" class="page-section">
                <h4 class="text-center mb-4 fw-bold">المؤسسات</h4>
                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم </th>
                                <th>رقم الهاتف</th>
                                <th>البريد الالكتروني</th>
                                <th>العملية</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>مؤسسة الخير</td>

                                <td></td>
                                <td></td>
                                <td>
                                    <i class="fa-solid fa-eye" onclick="showAddInstitution()"
                                        style="color: #3a2d87;"></i>
                                    <i class="fa-solid fa-trash" onclick="deleteRow(this)" style="color: #3a2d87;"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="addSection" class="box" style="display:none;">
                <div class="content">
                    <div class="form-card mx-auto" style="max-width: 1000px;">
                        <h4 class="text-center fw-bold mb-5">إضافة مؤسسة</h4>

                        <form>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="field-group">
                                        <label>الإسم</label>
                                        <input type="text" class="input-style">
                                    </div>
                                    <div class="field-group">
                                        <label>البريد الالكتروني</label>
                                        <input type="email" class="input-style">
                                    </div>
                                    <div class="field-group">
                                        <label>المحافظة</label>
                                        <input type="text" class="input-style">
                                    </div>
                                    <div class="field-group">
                                        <label>رابط الموقع</label>
                                        <input type="url" class="input-style">
                                    </div>
                                    <div class="field-group align-items-start">
                                        <label class="pt-2">الشروط</label>
                                        <textarea class="textarea-style"></textarea>
                                    </div>
                                    <div class="field-group align-items-start mt-3">
                                        <label class="pt-2">عن المؤسسة</label>
                                        <textarea class="textarea-style"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="field-group">
                                        <label>رقم الهاتف</label>
                                        <input type="text" class="input-style">
                                    </div>
                                    <div class="field-group">
                                        <label>العنوان</label>
                                        <input type="text" class="input-style">
                                    </div>
                                    <div class="field-group align-items-start">
                                        <label class="pt-2">الشعار</label>
                                        <div class="logo1-box">
                                            <i class="bi bi-file-earmark-arrow-up"></i>
                                            <p>إرفاق</p>
                                            <input type="file" id="upload-logo">
                                            <img id="preview"
                                                style="display:none; width:100%; height:100%; object-fit:contain; border-radius:20px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-save">حفظ</button>
                        </form>
                    </div>
                </div>



            </div>


            <div id="users" class="page-section">
                <h4 class="text-center mb-4 fw-bold">المستخدمين</h4>
                <div class="d-flex justify-content-center mb-4">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="text" id="idSearch" class="form-control shadow-none" placeholder="ادخل رقم الهوية"
                            style="border-radius: 0 25px 25px 0;">
                        <button class="btn btn-white border" style="border-radius: 25px 0 0 25px;"><i
                                class="bi bi-search"></i></button>
                    </div>
                </div>
                <div class="custom-table table-responsive">
                    <table class="table text-center align-middle mb-0" id="userTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الإسم</th>
                                <th>اسم المخيم</th>
                                <th>الدور</th>
                                <th>.....</th>
                                <th>العملية</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="123456789">
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="form-check form-switch d-inline-block"><input class="form-check-input"
                                            type="checkbox" checked></div>
                                </td>
                                <td>

                                    <i class="bi bi-shield-lock text-dark mx-1 fs-5" style="cursor:pointer"
                                        data-bs-toggle="modal" data-bs-target="#authModal"></i>
                                    <i class="bi bi-trash text-danger mx-1 fs-5" style="cursor:pointer"
                                        onclick="deleteRow(this)"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="contact" class="page-section">
                <h4 class="text-center mb-5 fw-bold">التواصل</h4>
                <div class="row g-4 mx-auto" style="max-width: 800px;">
                    <div class="col-md-6"><label>البريد الالكتروني</label><input type="text"
                            class="form-control form-control-custom m-t-4"></div>
                    <div class="col-md-6"><label>واتساب</label><input type="text"
                            class="form-control form-control-custom m-t-4"></div>
                    <div class="col-md-6"><label>لينكدإن</label><input type="text"
                            class="form-control form-control-custom m-t-4"></div>
                    <div class="col-md-6"><label>الهاتف</label><input type="text"
                            class="form-control form-control-custom m-t-4"></div>
                    <div class="col-md-12 text-center">
                        <div style="max-width: 385px; margin: auto;"><label>فيسبوك</label><input type="text"
                                class="form-control form-control-custom m-t-4"></div>
                    </div>
                </div>
                <div class="text-center mt-4"><button class="btn btn-save">حفظ</button></div>
            </div>
            <div id="reports" class="page-section text-center">
                <h4 class="mb-5 fw-bold">التقارير</h4>
                <div class="mx-auto" style="max-width: 400px;">
                    <select class="form-select form-control-custom" style="background-color: #bdb7e5;">
                        <option>إنشاء تقرير عام لكل المخيمات</option>
                    </select>
                    <select class="form-select form-control-custom" onclick="showPage('report-view')"
                        style="background-color: #bdb7e5;">
                        <option>إنشاء تقرير حالة لمخيم محدد</option>
                    </select>
                    <button class="btn  rounded-pill px-5 mt-3"
                        style="color: #3a2d87;background-color: white;padding:  5px 19px; border: 1px solid #bdb7e5;">إنشاء</button>
                </div>
            </div>

            <div id="report-view" class="page-section text-center ">
                <h4 class="mb-4 fw-bold">تقرير حالة مخيم الشجاعية - مارس 2025</h4>
                <p class="mx-auto" style="max-width: 700px; color: #555;">تقرير حالة مخيم الشجاعية - مارس 2025
                    يستعرض هذا التقرير الوضع الحالي لمخيم [اسم المخيم] من حيث عدد المستفيدين المسجلين، الأنشطة المنفذة،
                    والمساعدات المقدمة
                    خلال الفترة المحددة.
                    يهدف التقرير إلى توفير صورة شاملة تساعد إدارة المخيم على تقييم الأداء، متابعة الاحتياجات، واتخاذ
                    القرارات المناسبة
                    لتحسين مستوى الخدمات المقدمة للمستفيدين.
                </p>
                <button class="btn btn-save mt-4"><i class="bi bi-download me-2"></i> تنزيل التقرير</button>
            </div>


            <div id="messages" class="page-section">
                <h4 class="text-center mb-5 fw-bold">الرسائل</h4>

                <div class="mx-auto" style="max-width: 800px;">
                    @forelse($messages as $message)
                    <div class="message-item shadow-sm mb-3 p-3 bg-white rounded-4 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3 text-end">
                            <div class="user-avatar">
                                <i class="bi bi-person-fill fs-3 text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold">اسم المستخدم : {{ $message->name }}</div>
                                <div class="small text-muted">الموضوع : {{ $message->subject }}</div>
                                <div class="small text-muted">
                                    الحالة :
                                    @if($message->status === 'new')
                                    <span class="text-danger">جديدة</span>
                                    @else
                                    <span class="text-success">مقروءة</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 align-items-center">
                            <form action="{{ route('dashboard.messages.delete', $message->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف الرسالة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-0 bg-transparent p-0">
                                    <i class="bi bi-trash text-primary fs-5" style="cursor:pointer"></i>
                                </button>
                            </form>

                            <a href="{{ route('dashboard.messages.show', $message->id) }}">
                                <i class="bi bi-box-arrow-up-right text-primary fs-5" style="cursor:pointer"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info text-center">
                        لا توجد رسائل حتى الآن
                    </div>
                    @endforelse
                </div>
            </div>

            <div id="message-details" class="page-section">
                <h4 class="text-center mb-5 fw-bold">تفاصيل الرسالة</h4>

                @if(isset($selectedMessage))
                <div class="bg-white p-5 rounded-4 shadow-sm mx-auto text-start"
                    style="max-width: 800px; line-height: 2;">
                    <p><strong>الإسم:</strong> {{ $selectedMessage->name }}</p>
                    <p><strong>البريد الالكتروني:</strong> {{ $selectedMessage->email }}</p>
                    <p><strong>الموضوع:</strong> {{ $selectedMessage->subject }}</p>
                    <p><strong>الرسالة:</strong></p>
                    <p class="text-muted">{{ $selectedMessage->message }}</p>

                    <div class="text-center mt-5">
                        <a href="{{ route('messages.index') }}" class="btn btn-purple px-5"
                            style="background-color: #3a2d87; border-radius: 19px; color:white;">
                            إغلاق
                        </a>
                    </div>
                </div>
                @else
                <div class="alert alert-secondary text-center mx-auto" style="max-width: 800px;">
                    اختر رسالة لعرض تفاصيلها
                </div>
                @endif
            </div>

        </div>


        <footer class="pt-4 pb-3 " style="background: rgba(58, 45, 135, 0.11); border-radius: 19px;">
            <div class="container-fluid">

                <a class="navbar-brand d-flex align-items-center gap-2" href="الصفحة الرئيسية.html">
                    <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" width="60" />
                    <h3>خيمتي</h3>
                </a>

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="container py-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <p>📍 الموقع :غزة – فلسطين</p>
                                <p>✉ البريد الالكتروني : info@campflow.org</p>
                            </div>

                            <div class="col-md-6 text-md-start">
                                <p>📞 رقم التواصل : +970-000-000</p>
                                <p>⏰ ساعات العمل: 4:00 – 9:00</p>
                            </div>
                        </div>

                        <div class="d-flex gap-5">
                            <div class="d-flex gap-3">
                                <a href="#" class="text-dark"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="#" class="text-dark"><i class="fab fa-linkedin fa-lg"></i></a>
                                <a href="#" class="text-dark"><i class="fab fa-envelope fa-lg"></i></a>
                                <a href="#" class="text-dark"><i class="fab fa-instagram fa-lg"></i></a>
                            </div>
                            <span class="mb-2 mb-md-0" style=text-align:center> 2025All Rights Reserved ©</span>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </footer>
    </div>

    <div class="modal fade" id="authModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 shadow-lg text-center">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h6 class="fw-bold mb-0">إعداد المصادقة</h6>
                </div>
                <p class="fw-bold mt-2">تغيير كلمة السر</p>
                <input type="password" class="form-control form-control-custom" placeholder="كلمة السر الجديدة">
                <input type="password" class="form-control form-control-custom" placeholder="تأكيد كلمة السر">
                <button class="btn btn-save w-100 mt-2">حفظ</button>
            </div>
        </div>
    </div>

    @if(isset($selectedMessage))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showPage('message-details');
        });
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showPage(pageId) {
            document.querySelectorAll('.page-section').forEach(section => {
                section.style.display = 'none';
            });

            const page = document.getElementById(pageId);
            if (page) {
                page.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if(isset($subsection) && $subsection == 'show-camp')
            showPage('camp-info');
            @elseif(isset($subsection) && $subsection == 'edit-camp')
            showPage('delegate-form');
            @elseif(isset($subsection) && $subsection == 'show-request')
            showPage('delegate1-form');
            @elseif(isset($section))
            showPage('{{ $section }}');
            @else
            showPage('dashboard');
            @endif
        });

        function showInstitutions() {
            document.getElementById("institutionsSection").style.display = "block";
            document.getElementById("addSection").style.display = "none";
        }

        function showAddInstitution() {
            document.getElementById("institutionsSection").style.display = "none";
            document.getElementById("addSection").style.display = "block";
        }

        function deleteRow(btn) {
            btn.closest("tr").remove();
        }

        document.getElementById('upload-logo')?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview');
                    const icon = document.querySelector('.logo1-box i');
                    const text = document.querySelector('.logo1-box p');

                    if (img) {
                        img.src = e.target.result;
                        img.style.display = 'block';
                    }

                    if (icon) icon.style.display = 'none';
                    if (text) text.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
@endsection