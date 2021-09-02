<!-- MAIN CONTENT -->
    <main class="p-3 my-container">
      <h3 class="mx-3 text-center bg-primary text-light p-4">Enrollments</h3>
      <div class="container-fluid col-sm-12 justify-content-center">
        <table class="table bg-light shadow text-center table-striped table-borderless">
          <thead>
            <tr>
              <th scope="col">Date Submitted</th>
              <th scope="col">Grade Level</th>
              <th scope="col">Section</th>
              <th scope="col">First Name</th>
              <th scope="col">Middle Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Suffix</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($enrollments as $key => $enrollment): ?>
            <tr class="align-middle">
              <td><?= $enrollment->submitted_at ?></td>
              <td><?= $enrollment->grade_level ?></td>
              <td><?= $enrollment->section_name ?></td>
              <td><?= $enrollment->firstname ?></td>
              <td><?= $enrollment->middlename ?></td>
              <td><?= $enrollment->lastname ?></td>
              <td><?= $enrollment->suffix ?></td>
              <td><a href="<?= site_url()?>r/assessment/<?= $enrollment->student_id?>" type="button" class="btn btn-primary btn-sm ">Assess</a></td>
            </tr>
            <?php endforeach?>
          </tbody>
        </table>
      </div>
    </main> 