<div class="row"> <!--begin::Col-->
    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>{{ $availableBooks }}</h3>
                <p>Buku Tersedia</p>
            </div>
            <i class="bi bi-book small-box-icon"></i>
            <a href="{{ route('admin.books.index') }}"
                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
            </a>
        </div>
        <!--end::Small Box Widget 1-->
    </div> <!--end::Col-->
    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>{{ $borrowedBooks }}</h3>
                <p>Buku Terpinjam</p>
            </div>
            <i class="bi bi-book-half small-box-icon"></i><a href="#"
                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i> </a>
        </div> <!--end::Small Box Widget 2-->
    </div> <!--end::Col-->
    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>{{ $totalVisitor }}</h3>
                <p>Pengunjung</p>
            </div>
            <i class="bi bi-person-check small-box-icon"></i><a href="#"
                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i> </a>
        </div> <!--end::Small Box Widget 3-->
    </div>
    <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>{{ $totalStudents }}</h3>
                <p>Jumlah Mahasiswa</p>
            </div>
            <i class="bi bi-person-vcard small-box-icon"></i><a href="{{ route('admin.students.index') }}"
                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i> </a>
        </div> <!--end::Small Box Widget 3-->
    </div> <!--end::Col-->
</div> <!--end::Row-->
