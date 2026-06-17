<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة العقارات</title>

    <style>
        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            background: #f3f6fb;
            color: #1f2937;
        }

        .page {
            max-width: 1250px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: white;
            padding: 28px;
            border-radius: 18px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, .25);
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .header p {
            margin: 0;
            opacity: .9;
        }

        .card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,.07);
            overflow: hidden;
        }

        .toolbar {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            border-bottom: 1px solid #eef2f7;
        }

        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-form input {
            width: 360px;
            max-width: 100%;
            padding: 13px 15px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            outline: none;
            font-size: 14px;
        }

        .search-form input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        }

        .btn {
            border: none;
            border-radius: 12px;
            padding: 12px 18px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-gray {
            background: #6b7280;
            color: white;
        }

        .btn-edit {
            background: #16a34a;
            color: white;
            padding: 9px 14px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        thead {
            background: #f8fafc;
        }

        th, td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #eef2f7;
            vertical-align: middle;
        }

        th {
            color: #475569;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge {
            padding: 7px 13px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
        }

        .badge-person {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-company {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-empty {
            background: #f3f4f6;
            color: #6b7280;
        }

        .empty {
            padding: 45px;
            text-align: center;
            color: #64748b;
        }

        .pagination-box {
            padding: 22px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 7px;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .page-item .page-link,
        .page-item span {
            display: block;
            min-width: 38px;
            padding: 9px 12px;
            border-radius: 10px;
            text-align: center;
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            border: 1px solid #e2e8f0;
        }

        .page-item.active .page-link,
        .page-item.active span {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .page-item.disabled span {
            color: #94a3b8;
            background: #f8fafc;
        }

        @media(max-width: 768px) {
            .page {
                margin: 20px auto;
            }

            .toolbar {
                align-items: stretch;
            }

            .search-form,
            .search-form input,
            .search-form button,
            .search-form a {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="header">
        <h1>قائمة العقارات</h1>
        <p>عرض وتعديل رقم الرخصة، الرقم الموحد أو الهوية، ونوع المعلن</p>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="toolbar">
            <strong>عدد النتائج: {{ $estates->total() }}</strong>

            <form method="GET" action="{{ route('estates.index') }}" class="search-form">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="ابحث برقم العقار، الرخصة، الهوية، المدينة..."
                >

                <button type="submit" class="btn btn-primary">بحث</button>

                @if(request('search'))
                    <a href="{{ route('estates.index') }}" class="btn btn-gray">إلغاء</a>
                @endif
            </form>
        </div>

        @if($estates->count())
            <div class="table-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>المدينة</th>
                        <th>رقم الرخصة</th>
                        <th>الرقم الموحد / الهوية</th>
                        <th>نوع المعلن</th>
                        <th>المستخدم</th>
                        <th>رابط الهيئة</th>
                        <th>الههوية قبل التعديل </th>
                        <th>الإجراء</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($estates as $estate)
                        <tr>
                            <td>{{ $estate->id }}</td>
                            <td>{{ $estate->short_description ?? '-' }}</td>
                            <td>{{ $estate->city ?? '-' }}</td>
                            <td>{{ $estate->adLicense_number ?? '-' }}</td>
                            <td>{{ $estate->{'identityـorـunified'} ?? '-' }}</td>

                            <td>
                                @if($estate->estate_type == 1)
                                    <span class="badge badge-person">فرد</span>
                                @elseif($estate->estate_type == 2)
                                    <span class="badge badge-company">منشأة</span>
                                @else
                                    <span class="badge badge-empty">غير محدد</span>
                                @endif
                            </td>

                            <td>{{ $estate->userad?->name ?? '-' }}</td>
                            
                            
<td>
    @php
        $identity =
            $estate->{'identityـorـunified'}
            ?? $estate->agent?->identity
            ?? $estate->agent?->unified_number;
    @endphp

    {{ $identity ?? '-' }}

    {{-- زر النقل --}}
    @if(empty($estate->{'identityـorـunified'}) && !empty($identity))
        <form method="POST" action="{{ route('estates.transferIdentity', $estate->id) }}" style="margin-top:8px;">
            @csrf

            <input type="hidden" name="identity_value" value="{{ $identity }}">

            <button type="submit" class="btn btn-primary" style="padding:6px 10px;">
                نقل
            </button>
        </form>
    @endif
</td>

                            <td>
                                <a href="{{ route('estates.edit', $estate->id) }}" class="btn btn-edit">
                                    تعديل
                                </a>
                            </td>
                            
                            
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-box">
                {{ $estates->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="empty">
                لا توجد عقارات مطابقة للبحث
            </div>
        @endif
    </div>
</div>

</body>
</html>