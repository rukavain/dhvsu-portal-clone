<?php include("database.php"); ?>

<section class="vh-100 w-100" style="background-color: #eee;">

    <div class="fluid-container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100 w-100">

            <div class="col col-lg-10 col-xl-11">
                <div class="card rounded-3">
                    <div class="card-body p-4">

                        <h4 class="text-center my-3 pb-3">Announcements</h4>

                        <table class="table mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date</th>

                                    <?php if ($isAdmin) { ?>
                                        <th scope="col">Actions</th>
                                    <?php } ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch data from the announcement_tbl
                                $stmt = $conn->query("SELECT * FROM announcement_tbl");
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php
                                $i = 0;
                                if (count($rows) > 0) {
                                    foreach ($rows as $row) {
                                        $i++;
                                ?>
                                        <tr>
                                            <th scope="row"> <?php echo $i; ?> </th>
                                            <td> <?php echo htmlspecialchars_decode($row['title']) ?> </td>
                                            <td style="max-width: 500px; min-width: 300px;"> <?php echo htmlspecialchars_decode($row['description']) ?> </td>
                                            <td><?php echo $row['start_date'] . ' - ' . $row['end_date']; ?></td>

                                            <?php if ($isAdmin) { ?>
                                                <td class="text-center">
                                                    <button type="submit" class="btn btn-primary ms-1" onclick="update_row('<?= $row['id'] ?>')">Edit</button>
                                                    <button type="submit" class="btn btn-danger" onclick="delete_row('<?= $row['id'] ?>')">Delete</button>
                                                </td>

                                            <?php } ?>


                                        </tr>

                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="5">No announcements found.</td></tr>';
                                }
                                ?>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function delete_row(id) {
        if (confirm("Are you sure you want to delete?")) {
            location.replace('dashboard_04b_delete.php?id=' + id);
        }
    }

    function update_row(id) {
        location.replace('dashboard_04c_update.php?id=' + id);
    }
</script>