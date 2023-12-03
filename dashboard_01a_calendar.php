     <!-- START OF PAGE CONTENT - CALENDAR  -->
     <div id="content" class="p-4 p-md-5 pt-5">
         <h2 class="mb-4 ">CALENDAR DASHBOARD</h2>
         <!-- eto ung calendar content -->
         <div class="whole-schedule-content">
             <div class="fluid-container py-5" id="page-container">
                 <div class="row">
                     <div class="col-md-12">
                         <div id="calendar"></div>
                     </div>

                 </div>
             </div>
             <!-- Event Details Modal -->
             <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                 <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content rounded-0">
                         <div class="modal-header rounded-0">
                             <h5 class="modal-title">Schedule Details</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body rounded-0">
                             <div class="container-fluid">
                                 <dl>
                                     <dt class="text-muted">Title</dt>
                                     <dd id="title" class="fw-bold fs-4"></dd>
                                     <dt class="text-muted">Description</dt>
                                     <dd id="description" class=""></dd>
                                     <dt class="text-muted">Start</dt>
                                     <dd id="start" class=""></dd>
                                     <dt class="text-muted">End</dt>
                                     <dd id="end" class=""></dd>
                                 </dl>
                             </div>
                         </div>
                         <div class="modal-footer rounded-0">
                             <div class="text-end">
                                 <button type="button" class="btn btn-success btn-sm rounded-0" id="viewParticipants" data-id="">View Participants</button>
                                 <button type="button" class="btn btn-success btn-sm rounded-0" id="register" data-id="">Register</button>

                                 <?php if ($isAdmin) {
                                        echo <<< HTML
                                            <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                                        HTML;
                                    } ?>

                                 <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Event Details Modal -->
             <!-- START OF MODAL -->
             <div class="modal fade" id="exampleModalCenter" tabindex="-1">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title text-center w-100" id="exampleModalLongTitle">New Events</h5>


                         </div>
                         <div class="modal-body">
                             <!-- schedule form -->
                             <div class="w-100">
                                 <div class="cardt rounded-0 ">

                                     <div class="card-body">
                                         <div class="container-fluid">
                                             <form action="dashboard_03_save_schedule.php" method="post" id="schedule-form">
                                                 <input type="hidden" name="id" value="">
                                                 <div class="form-group mb-2">
                                                     <label for="title" class="control-label text-dark">Title</label>
                                                     <input type="text" class="form-control form-control-sm rounded-0 border" name="title" id="title" required>
                                                 </div>
                                                 <div class="form-group mb-2">
                                                     <label for="description" class="control-label text-dark">Description</label>
                                                     <textarea rows="3" class="form-control form-control-sm rounded-0 border" name="description" id="description" required></textarea>
                                                 </div>
                                                 <div class="form-group mb-2">
                                                     <label for="start_datetime" class="control-label text-dark">Start</label>
                                                     <input type="datetime-local" class="form-control form-control-sm rounded-0 border" name="start_datetime" id="start_datetime" required>
                                                 </div>
                                                 <div class="form-group mb-2">
                                                     <label for="end_datetime" class="control-label text-dark">End</label>
                                                     <input type="datetime-local" class="form-control form-control-sm rounded-0 border" name="end_datetime" id="end_datetime" required>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>

                                 </div>
                             </div>
                             <!-- end of schedule form -->
                         </div>
                         <div class="modal-footer">

                             <div class="text-center">
                                 <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                 <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Clear</button>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
             <!-- END OF MODAL -->

             <?php
                $schedules = $conn->query("SELECT * FROM `schedule_list`");
                $sched_res = [];
                foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
                    $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
                    $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
                    $sched_res[$row['id']] = $row;
                }
                ?>
             <?php
                if (isset($conn)) $conn->close();
                ?>
         </div>
     </div>
     <!-- END OF PAGE CONTENT - CALENDAR -->

     <!-- FOR REGISTERING STUDENT -->

     <form class="visually-hidden" action="register_01a_process.php" method="post" id="register-form">
         <input type="hidden" name="regid" value="">
         <input type="hidden" name="studentid" value="<?= $_SESSION['user_id'] ?>">
     </form>
     <!-- END OF REGISTERING STUDENT -->

     <script>
         document.getElementById('viewParticipants').addEventListener('click', function() {
             var dataIdViewParticipants = this.getAttribute('data-id');
             // Redirect to a new page with the data-id value as a URL parameter
             window.location.href = 'dashboard_06_viewParticipants.php?dataId=' + encodeURIComponent(dataIdViewParticipants);
         });
     </script>