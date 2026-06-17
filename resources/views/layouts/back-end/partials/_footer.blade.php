<div class="footer">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-4 mb-2 mb-lg-0">
            <p class="font-size-sm mb-0 title-color text-center text-lg-left">
                جميع الحقوق محفوظة
                <span class="d-none d-sm-inline-block">لدى امارة منطقة عسير</span>
            </p>
        </div>
        <div class="col-lg-8 mb-2 mb-lg-0">
            <div class="d-flex justify-content-center justify-content-lg-end">
                <ul class="list-inline list-footer-icon justify-content-center justify-content-lg-start mb-0">
                    <li class="list-inline-item">
                        <a class="list-separator-link" href="">
                            <i class="tio-settings"></i>
                           إعدادت النظام
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="list-separator-link"
                           href="{{route('admin.profile.update',auth('admin')->user()->id)}}">
                            <i class="tio-user"></i>
                           الملف الشخصي
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="list-separator-link" href="{{route('admin.dashboard.index')}}">
                            <i class="tio-home"></i>
                          الرئيسية
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <label class="badge badge-soft-version text-capitalize m-0">
                            {{'اصدار النسخة'.' '.      1.0}}
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
