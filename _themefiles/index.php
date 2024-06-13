<?php include 'header.php'; ?>
<!-- Start Page Content here -->
        <!-- ============================================================== -->



            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">Dashboard</h4>
                            </div>
                            <div class="col-lg-6">
                               <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <!-- <li class="breadcrumb-item active">Dashboard</li> -->
                                </ol>
                               </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Daily</span>
                                        <h5 class="card-title mb-0">Sprout Progress</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                               98%
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">12.5% <i
                                                    class="mdi mdi-arrow-up text-success"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Per Week</span>
                                        <h5 class="card-title mb-0">Bloom Progress</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                56%
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">18.71% <i
                                                    class="mdi mdi-arrow-down text-danger"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Per Month</span>
                                        <h5 class="card-title mb-0">Harvest Progress</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                99%
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">57% <i
                                                    class="mdi mdi-arrow-up text-success"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;">
                                        </div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div>
                            <!--end card-->
                        </div> <!-- end col-->

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <span class="badge badge-soft-primary float-end">Yearly</span>
                                        <h5 class="card-title mb-0">Seasonal Progress</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                47%
                                            </h2>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span class="text-muted">17.8% <i
                                                    class="mdi mdi-arrow-down text-danger"></i></span>
                                        </div>
                                    </div>

                                    <div class="progress shadow-sm" style="height: 5px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                                    </div>
                                </div>
                                <!--end card body-->
                            </div><!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->


                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Total Projects In Running</h4>
                                    <p class="card-subtitle mb-4">Weekly Projects Status</p>
                                    <div id="morris-bar-example" class="morris-chart"></div>
                                    <h3>04 <span class="badge badge-soft-success float-end">02 Completed</span></h3>
                                </div> <!--end card body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pending Projects</h4>
                                    <p class="card-subtitle mb-4">Weekly Pending Projects Status</p>
                                    <div class="text-center">
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <p class="text-muted font-15 mb-1 text-truncate">This Week Target</p>
                                                <h4><i class="fas fa-arrow-up text-success me-1"></i>20 Projects</h4>

                                            </div>
                                            <div class="col-6">
                                                <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                                <h4><i class="fas fa-arrow-down text-danger me-1"></i>11 Projects</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!--end card body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="card-title">Daily Projects Revisions</h4>
                                            <p class="card-subtitle mb-4">Running Projects Revisions</p>
                                            <h3>20<span class="badge badge-soft-success float-end">10 Completed</span>
                                            </h3>
                                        </div>
                                    </div> <!-- end row -->

                                    <div id="sparkline1" class="mt-3"></div>
                                </div>
                                <!--end card body-->
                            </div>
                            <!--end card-->

                        </div><!-- end col -->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Developer Daily Status</h4>
                                    <p class="card-subtitle mb-4 font-size-13">Developer and Developer intern work Load status</p>

                                    <div class="table-responsive">
                                        <table class="table table-centered table-striped table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Developer Name</th>
                                                    <th>Working On Project</th>
                                                    <th>Developer Status</th>
                                                    <th>Total Hour</th>
                                                    <th>HOD Status</th>
                                                    <th>Deadline Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Ali Humdard</a>
                                                    </td>
                                                    <td>
                                                        Online Pharmacy 4U
                                                    </td>
                                                    <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning">Pending</button>
                                                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Running</a>
                                                            <a class="dropdown-item" href="#">Puzzlement</a>
                                                            <a class="dropdown-item" href="#">Complete</a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    02:30 Hour
                                                    </td>
                                                    <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info">Assigned</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Not Approved</a>
                                                            <a class="dropdown-item" href="#">Revision</a>
                                                            <a class="dropdown-item" href="#">Approved</a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        04 May, 2024
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-8.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Kathryn S.
                                                            Collier</a>
                                                    </td>
                                                    <td>
                                                        Online Pharmacy 4U
                                                    </td>
                                                    <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success">Completed</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Running</a>
                                                            <a class="dropdown-item" href="#">Puzzlement</a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                    02:30 Hour
                                                    </td>
                                                    <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success">Approved</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Not Approved</a>
                                                            <a class="dropdown-item" href="#">Revision</a>
                                                            <a class="dropdown-item" href="#">Assigned</a>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        04 May, 2024
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Bryan J. Luellen</a>
                                                    </td>
                                                    <td>
                                                        215-302-3376
                                                    </td>
                                                    <td>
                                                        bryuellen@dayrep.com
                                                    </td>
                                                    <td>
                                                        New York
                                                    </td>
                                                    <td>
                                                        09/12/2018
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="table-user">
                                                        <img src="assets/images/users/avatar-5.jpg" alt="table-user"
                                                            class="mr-2 avatar-xs rounded-circle">
                                                        <a href="javascript:void(0);"
                                                            class="text-body font-weight-semibold">Zara Raws</a>
                                                    </td>
                                                    <td>
                                                        (02) 75 150 655
                                                    </td>
                                                    <td>
                                                        austin@dayrep.com
                                                    </td>
                                                    <td>
                                                        Germany
                                                    </td>
                                                    <td>
                                                        07/15/2018
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!--end card body-->

                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->

                    </div>
                    <!--end row-->

                </div> <!-- container -->

            </div> <!-- content -->

            

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <?php include 'footer.php' ?>