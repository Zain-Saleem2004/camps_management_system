@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --main-purple: #4a3f9d;
            --light-bg: #f8f9fc;
            --card-bg: #e9e9f7;
            --sidebar-width: 220px;
        }

        body {
            background-color: var(--light-bg);

            padding: 5px 6px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            border-radius: 19px;
            background: rgba(58, 45, 135, 0.11);
            ;
            border-bottom: 1px solid #eee;
        }

        .logout-link {
            color: var(--main-purple);
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            background: transparent;
            padding: 6px 20px;
            border-radius: 20px;
            transition: 0.3s;
            border: 1px solid rgba(58, 45, 153, 0.38);

        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--main-purple);
            min-height: 100vh;
            position: fixed;
            right: 0;
            top: 0;
            color: white;
            z-index: 1000;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar-logo {
            width: 80px;

            height: 80px;

            border-radius: 50%;

            object-fit: cover;

            border: 3px solid rgba(255, 255, 255, 0.2);

            background-color: white;

            padding: 5px;
        }

        .sidebar-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: white;
            color: var(--main-purple);
            border-radius: 25px 0 0 25px;
            margin-left: -1px;
        }

        .main-content {
            margin-right: var(--sidebar-width);
            padding: 0px;
            min-height: calc(100vh - 180px);

        }


        .stat-card {
            background-color: rgba(68, 52, 160, 0.11);
            border-radius: 20px;
            padding: 30px 0PX;
            text-align: center;
            border: none;
        }

        .custom-input {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 10px 20px;
        }

        .content {
            margin-right: 240px;
            padding: 20px;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .page-section {
            display: none;

            padding: 30px 10px;
            text-align: center;
        }

        .page-section.active {
            display: block;
        }


        footer {
            background-color: #e2e4f0;
            margin-right: var(--sidebar-width);
            padding: 25px;
            border-top-right-radius: 40px;
            border-top-left-radius: 40px;

        }

        .table thead {
            background-color: #d9d9f3;
        }
    </style>
</head>

<body>

    <div class="sidebar shadow">
        <!-- <div class="text-center py-4">
             
        </div> -->
        <div class="logo-container">
            <img src="{{ asset('assets/images/img1__5_-removebg-preview (1).png') }}" alt="لوجو خيمتي" class="sidebar-logo">
        </div>
        <a href="{{ route('dashboard') }}" class="sidebar-link">
            <i class="bi bi-grid"></i> لوحة التحكم
        </a>
        <a href="{{ route('camps.index') }}" class="sidebar-link">
            <i class="bi bi-houses"></i> المخيمات
        </a>
        <div class="sidebar-link" onclick="showSection('camp-info', this)"><i class="bi bi-info-circle"></i> معلومات
            المخيم</div>
        <div class="sidebar-link" onclick="showSection('reports', this)"><i class="bi bi-file-earmark-text"></i>
            التقارير</div>

        <div class="sidebar-link" onclick="showSection('contact', this)"><i class="bi bi-person-lines-fill"></i> التواصل
        </div>
    </div>


    <div class="main-content">

        <div class="top-bar">
            <div class="user-name small fw-bold">محمد سلمان : مدخل بيانات</div>
            <div class="d-flex align-items-center">

                <a href="{{ route('home') }}" class="logout-link small">تسجيل الخروج</a>
                <i class="fa-solid fa-gear text-muted" style="cursor:pointer"></i>
            </div>
        </div>


        @if(($section ?? 'dashboard') == 'dashboard')
        <div id="dashboard" class="page-section active text-center">
            <h4 class="mb-4 font-weight-bold">لوحة التحكم</h4>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <h3>{{ $campsCount }}</h3>
                        <p>مخيم</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <h3>{{ $adminsCount }}</h3>
                        <p>مشرفين</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <h3>{{ $representativesCount }}</h3>
                        <p>الممثلين</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <h3>{{ $dataEntriesCount }}</h3>
                        <p>ادخال بيانات</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <h3>{{ $supportersCount }}</h3>
                        <p>المؤسسات</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card shadow-sm">
                        <h3>{{ $messagesCount }}</h3>
                        <p>الرسائل</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(($section ?? '') == 'camps')
        <div id="camps" class="page-section active">
            <h4 class="text-center">المخيمات</h4>

            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('camps.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> إضافة
                </a>
            </div>

            <div class="card card-custom p-3">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>المحافظة</th>
                            <th>الحالة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($camps as $camp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $camp->name }}</td>
                            <td>{{ $camp->governorate }}</td>
                            <td>{{ $camp->status }}</td>
                            <td>
                                <a href="{{ route('camps.show', $camp->id) }}" class="text-info mx-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('camps.edit', $camp->id) }}" class="text-warning mx-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('camps.destroy', $camp->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn p-0 border-0 text-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">لا توجد مخيمات</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(($subsection ?? '') == 'show-camp')
            <div class="card card-custom p-4 mt-4 text-end">
                <h4 class="mb-3">تفاصيل المخيم</h4>

                <div class="mb-2"><strong>اسم المخيم:</strong> {{ $selectedCamp->name }}</div>
                <div class="mb-2"><strong>المحافظة:</strong> {{ $selectedCamp->governorate }}</div>
                <div class="mb-2"><strong>الموقع:</strong> {{ $selectedCamp->location }}</div>
                <div class="mb-2"><strong>عدد العائلات:</strong> {{ $selectedCamp->families_count }}</div>
                <div class="mb-2"><strong>الحالة:</strong> {{ $selectedCamp->status }}</div>

                <div class="mt-3">
                    <a href="{{ route('camps.index') }}" class="btn btn-secondary">رجوع</a>
                </div>
            </div>
            @endif

            @if(($subsection ?? '') == 'edit-camp')
            <div class="card card-custom p-4 mt-4 text-end">
                <h4>تعديل المخيم</h4>

                <form action="{{ route('camps.update', $selectedCamp->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" name="name" value="{{ $selectedCamp->name }}" class="form-control mb-2">
                    <input type="text" name="governorate" value="{{ $selectedCamp->governorate }}" class="form-control mb-2">
                    <input type="text" name="location" value="{{ $selectedCamp->location }}" class="form-control mb-2">
                    <input type="number" name="families_count" value="{{ $selectedCamp->families_count }}" class="form-control mb-2">

                    <select name="status" class="form-control mb-2">
                        <option value="active" {{ $selectedCamp->status == 'active' ? 'selected' : '' }}>active</option>
                        <option value="inactive" {{ $selectedCamp->status == 'inactive' ? 'selected' : '' }}>inactive</option>
                    </select>

                    <button class="btn btn-primary">حفظ</button>
                </form>
            </div>
            @endif

        </div>
        @endif


        <div id="camp-info" class="page-section text-center">
            <h1 class="mb-4">معلومات المخيم</h1>
            <div class="mx-auto" style="max-width: 700px;">
                <div class="d-flex align-items-center">
                    <label for="" style="margin-left: 10px; width: 90px;">
                        اسم المخيم
                    </label>
                    <input type="text" class="form-control custom-input mb-1 ml-3">
                </div>
                <div class="d-flex align-items-center">
                    <label for="" style="margin-left: 10px; width: 90px;">
                        العنوان
                    </label>
                    <input type="text" class="form-control custom-input mb-3">
                </div>
                <div class="d-flex align-items-center">
                    <label for="" style="margin-left: 10px; width: 90px;">
                        المحافظة
                    </label>
                    <input type="text" class="form-control custom-input mb-3">
                </div>
                <div class="d-flex align-items-center">
                    <label for="" style="margin-left: 10px; width: 90px;">
                        عدد الحالات
                    </label><input type="number" class="form-control custom-input mb-3">
                </div>
            </div>
        </div>

        <div id="reports" class="page-section text-center">
            <h4 class="mb-4">التقارير</h4>
            <div class="mx-auto" style="max-width: 400px;">
                <select class="form-select custom-input mb-3" style="background-color: rgba(58, 45, 135, 0.11);">
                    <option>إنشاء تقرير عام لكل المخيمات</option>
                </select>
                <select class="form-select custom-input mb-3" style="background-color: rgba(58, 45, 135, 0.11);">
                    <option>تقرير حالة لمخيم محدد</option>
                </select>
                <button class="btn btn-light shadow-sm border rounded-pill px-5">إنشاء</button>
            </div>
        </div>



        <div id="contact" class="page-section">
            <h4 class="text-center mb-4">التواصل</h4>
            <div class="row g-3 mx-auto" style="max-width: 600px;">
                <div class="col-md-6"><input type="text" class="form-control custom-input"
                        placeholder="البريد الإلكتروني"></div>
                <div class="col-md-6"><input type="text" class="form-control custom-input" placeholder="واتساب"></div>
                <div class="col-md-6"><input type="text" class="form-control custom-input" placeholder="لينكدإن"></div>
                <div class="col-md-6"><input type="text" class="form-control custom-input" placeholder="الهاتف"></div>
                <div class="col-md-6"><input type="text" class="form-control custom-input" placeholder="فيسبوك"></div>
                <div class="col-12 text-center"><button class="btn btn-primary rounded-pill px-5"
                        style="background-color: var(--main-purple);">حفظ</button></div>
            </div>
        </div>

    </div>
    <footer class="pt-4 pb-3 " style="background: rgba(58, 45, 135, 0.11); border-radius: 19px;">
        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
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


    <script>
        function showSection(id, el) {
            document.querySelectorAll('.page-section').forEach(s => s.classList.remove('active'));
            document.getElementById(id).classList.add('active');
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            el.classList.add('active');
        }

        let counter = 2;


        // function addCamp() {

        //     let name = prompt("اسم المخيم:");

        //     let covernorate = prompt("المحافظة:");
        //     let email = prompt("البريد:");

        //     if (!name || !email) return;

        //     let table = document.getElementById("tableBody");


        //     let empty = document.getElementById("emptyRow");
        //     if (empty) empty.remove();

        //     let row = `
        //         <tr>
        //             <td>${counter}</td>
        //             <td>${name}</td>
        //             <td>${covernorate}</td>
        //             <td>${email}</td>
        //             <td>
        //                 <i class="bi bi-eye text-info mx-1" onclick="viewRow(this)"></i>
        //                 <i class="bi bi-pencil text-warning mx-1" onclick="editRow(this)"></i>
        //                 <i class="bi bi-trash text-danger mx-1" onclick="deleteRow(this)"></i>
        //             </td>
        //         </tr>`;

        //     table.innerHTML += row;
        //     counter++;
        // }


        // function viewRow(el) {
        //     let row = el.parentElement.parentElement;
        //     alert("الاسم: " + row.children[2].innerText +
        //         "\nالبريد: " + row.children[3].innerText);
        // }


        // function editRow(el) {
        //     let row = el.parentElement.parentElement;

        //     let name = prompt("تعديل الاسم:", row.children[2].innerText);
        //     let email = prompt("تعديل البريد:", row.children[3].innerText);

        //     if (name) row.children[2].innerText = name;
        //     if (email) row.children[3].innerText = email;
        // }


        // function deleteRow(el) {
        //     if (confirm("حذف؟")) {
        //         el.parentElement.parentElement.remove();
        //     }
        // }
    </script>
</body>

</html>
@endsection