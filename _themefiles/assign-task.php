<?php include 'header.php'; ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Floating labels</h5>
                <p class="sub-header">Create beautifully simple form labels that float over your input fields.</p>

                <form>
                    <div class="row">
                    <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Project Name" value="Tech Solutions Pro Task Management">
                                <label for="floatingnameInput">Project Name</label>
                            </div>
                        </div>    
                    <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Ticket Number" value="#373">
                                <label for="floatingnameInput">Ticket Number</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                    <option selected="">Please select one from blow</option>
                                    <option value="1">CEO</option>
                                    <option value="2">Drictor</option>
                                    <option value="3">Team Lead</option>
                                    <option value="4">IT Manager</option>
                                </select>
                                <label for="floatingSelectGrid">Assign By</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                    <option selected="">Please select one from blow</option>
                                    <option value="1">Ali Humdard</option>
                                    <option value="2">Mudasar Hussain</option>
                                    <option value="3">Asad Khan</option>
                                </select>
                                <label for="floatingSelectGrid">Assign To</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingemailInput" placeholder="Enter Email address" value="name@example.com">
                                <label for="floatingemailInput">Email address</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                    <option selected="">Select Task Priority</option>
                                    <option value="1">Urgent</option>
                                    <option value="2">Height</option>
                                    <option value="3">Medium</option>
                                    <option value="3">Low</option>
                                </select>
                                <label for="floatingSelectGrid">Priority</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <p class="form-control" id="currentDate"></p>
                                <script>
                                    const d = new Date();
                                    const options = {
                                        month: 'long',
                                        day: 'numeric',
                                        year: 'numeric'
                                    };
                                    const formattedDate = d.toLocaleDateString('en-US', options);
                                    document.getElementById("currentDate").innerHTML = formattedDate;
                                </script>

                                <label for="floatingSelectGrid">Assign Date</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-3">
                                <p class="form-control" id="currentTime"></p>
                                <script>
                                    
                                    const timeOptions = {
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit',
                                        hour12: true
                                    };
                                    const formattedTime = d.toLocaleTimeString('en-US', timeOptions);
                                    document.getElementById("currentTime").innerHTML = formattedTime;
                                </script>

                                <label for="floatingSelectGrid">Assign Date</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" data-gramm="false" wt-ignore-input="true">123, Main st</textarea>
                        <label for="floatingTextarea">Comments</label>
                    </div>

                    <div class="mb-3">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="floatingCheck">
                            <label class="form-check-label" for="floatingCheck">
                                Check me out
                            </label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
                                

<?php include 'footer.php'; ?>