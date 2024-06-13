<?php include 'header.php'; ?>

<div class="px-3">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Add Team Lead</h4>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Form Elements</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Team Lead Details required </h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="p-2">
                                    <form class="form-horizontal" role="form">
                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="simpleinput">Full Name</label>
                                            <div class="col-md-10">
                                                <input type="text" id="simpleinput" class="form-control" placeholder="Type here full name...">
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-email">Email</label>
                                            <div class="col-md-10">
                                                <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-password">Password</label>
                                            <div class="col-md-10">
                                                <input type="password" class="form-control" id="example-password" placeholder="Password">
                                            </div>
                                        </div>
                                        <!-- <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-placeholder">Placeholder</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" id="example-placeholder" placeholder="placeholder">
                                                            </div>
                                                        </div> -->
                                        <!-- <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-textarea">Text area</label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                                            </div>
                                                        </div> -->


                                        <!-- <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label">Disabled</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" disabled="" value="Disabled value">
                                                            </div>
                                                        </div> -->


                                        <!-- <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-helping">Helping text</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" id="example-helping" placeholder="Helping text">
                                                                <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                                                            </div>
                                                        </div> -->

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-fileinput">Profile Picture</label>
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" id="example-fileinput">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-date">Joining Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="date" name="date" id="example-date">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-month">Contract Expired</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="date" name="date" id="example-date">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-time">Working Time Start</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="time" id="example-time" name="time">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-time">Working Time End</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="time" id="example-time" name="time">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-number">Phone Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" id="example-number" name="number">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label">WhatsApp</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="tel" name="tel">
                                            </div>
                                        </div>

                                        <div class="mb-2 form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Confirm you are adding this person as Team Lead</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end row -->
                    </div>
                </div> <!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->

        <!-- end row -->

    </div> <!-- container -->

</div>

<?php include 'footer.php' ?>