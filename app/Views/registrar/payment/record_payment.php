<main class="p-4">
  <!-- breadcrumb -->
  <div class="d-flex justify-content-between border-bottom mb-5">
    <h4>Record Payment</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= site_url()?>r/dashboard">Home</a></li>
        <li class="breadcrumb-item active"><a href="<?= site_url()?>r/payment">Payment</a></li>
        <li class="breadcrumb-item active" aria-current="page">Record Payment</li>
      </ol>
    </nav>
  </div>  
  
  <?php  
    $all_fees = $fees['library'] + $fees['medical'] + $fees['guidance'] + $fees['foundation'] + $fees['modules'] + $fees['disinfectant'] + $fees['internet'] + $fees['maintenance'] + $fees['learning'] + $fees['tuition'];
  ?>

  <!-- Button trigger modal -->
  <div class="d-flex gap-4 justify-content-end mb-5">
    <button class="btn btn-danger btn-sm" onclick="print('p_information', 'payment_summary_report_<?= date('now')?>', 'portrait')"><i class="fas fa-download"></i> Download</button>

    <button type="button" <?= (isset($c_payment) && $c_payment['balance'] <= 0) ? 'disabled' : '' ?>  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#receivePayment">
      <i class="fas fa-cash-register me-1"></i> Receive Payment
    </button>
  </div>

  <section id="p_information">
    <div class="p-4 border mb-5">
      <table class="table table-borderless align-middle">
        <thead class="border-bottom">
          <tr class="table-primary">
            <th colspan="2" class="text-center h5 fw-bold p-4">Student Information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Student's Name:</th>
            <td>
              <?= $student['firstname'].' ' ?>
              <?php if($student['middlename']): ?>
                <?= substr($student['middlename'], 0, 1).'. ' ?>
              <?php endif ?>
              <?= $student['lastname'].' ' ?>
              <?php if($student['suffix']): ?>
                <?= $student['suffix'] ?>
              <?php endif ?>
            </td>
          </tr>

          <tr>
            <th>Grade Level:</th>
            <td>
              <?= $student['grade_level']?>
            </td>
          </tr>

          <tr>
            <th>Class:</th>
            <td>
              <?= $student['class_name']?>
            </td>
          </tr>

          <tr>
            <th>Course:</th>
            <td>
              <?= $student['track_name']?> - 
              <?= $student['strand_name']?>
            </td>
          </tr>

          <tr>
            <th>Academic Year:</th>
            <td>
              <?= $student['acad_year']?>
            </td>
          </tr>

          <tr>
            <th>Payment Status:</th>
            <td>
              <?php if(count($payment) > 0) : ?>
                <?php if($c_payment['balance'] > 0): ?>
                  <div class="alert alert-warning p-1 mb-0">
                    <strong>
                      <i class="fas fa-exclamation-circle me-1 fa-fw"></i> 
                      <span class="text-capitalize">
                        Partially Paid
                      </span>
                    </strong>
                  </div>
                <?php else: ?>
                  <div class="alert alert-success p-1 mb-0">
                    <strong>
                      <i class="fas fa-check-circle me-1 fa-fw"></i> 
                      <span class="text-capitalize">
                        Fully Paid
                      </span>
                    </strong>
                  </div>
                <?php endif ?>
              <?php else: ?>
                <div class="alert alert-danger p-1 mb-0">
                  <strong>
                    <i class="fas fa-exclamation-circle me-1 fa-fw"></i> 
                    <span class="text-capitalize">
                      No Payment has been made yet!
                    </span>
                  </strong>
                </div>
              <?php endif ?>
            </td>
          </tr>

          <tr>
            <th>Date of Enrollment:</th>
            <td>
              <?= date('M d, Y @ h:i:s a', strtotime($student['submitted_at']))?>
            </td>
          </tr>

          <tr>
            <th>Tuition Fee:</th>
            <td>
              &#8369; <?= number_format($fees['tuition']) ?>
            </td>
          </tr>

          <tr>
            <?php  
              $fee = $fees['library'] + $fees['medical'] + $fees['guidance'] + $fees['foundation'] + $fees['modules'] + $fees['disinfectant'] + $fees['internet'] + $fees['maintenance'] + $fees['learning'];
            ?>
            <th>Other Fees:</th>
            <td>
              &#8369; <?= number_format($fee) ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="border p-4">
      <table class="table table-borderless align-middle">
        <thead>
          <tr class="table-success">
            <th colspan="5" class="text-center h5 fw-bold p-4">Payment Summary</th>
          </tr>
          <tr>
            <th></th>
            <th>Total Amount Payable</th>
            <th>Amount Paid</th>
            <th>Payment Date</th>
            <th>Academic Year</th>
          </tr>
          <tr class="table-primary">
            <th>AP</th>
            <th>
              &#8369; <?= number_format($all_fees) ?>
            </th>
            <th>-</th>
            <th>-</th>
            <th>
              <?= $student['acad_year']?>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($payment) > 0): ?>
            <?php foreach($payment as $key => $p): ?>
            <tr>
              <td>
                <?php 
                  $i = $key + 1;
                  echo $i;
                ?>
              </td>
              <td>&#8369; <?= number_format($p['balance']) ?></td>
              <td>&#8369; <?= number_format($p['amount']) ?></td>
              <td><?= date('M d, Y @ h:i a', strtotime($p['recorded_at'])) ?></td>
              <td><?= $p['acad_year'] ?></td>
            </tr>
            <?php endforeach ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="p-5">
                <div class="alert alert-danger mb-0 text-center"><strong><i class="fas fa-exclamation-circle fa-fw me-1"></i>No Payment has been made yet!</strong></div>
              </td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="receivePayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="receivePaymentLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="receivePaymentLabel"><i class="fas fa-cash-register"></i> Receive Payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?= form_open('r/payment/save') ?>
         <?= csrf_field() ?>
         <?= form_hidden('f', $fees['fee_id']) ?>
         <?= form_hidden('s', $student['student_id']) ?>

         <?php $balance = (count($payment) > 0) ? $p['balance'] : $all_fees?>

         <?= form_hidden('bal', $balance) ?>
        <div class="modal-body">
          <div class="mb-3">
            <label for="ay" class="form-label"><span class="text-danger">*</span>Academic Year</label>
            <select name="ay" id="ay" class="form-select form-select-sm">
              <option value="" selected disabled>Select Academic Year</option>
              <?php for($i = 0; $i < 4; $i++): ?>
                <?php $start_y = $now->getYear() - 2?>
                <?php $acad_year = $start_y + $i."-".$start_y + $i + 1 ?>
                <option value="<?= $acad_year?>" <?= ($acad_year == $student['acad_year']) ? set_select('ay', $acad_year, TRUE) : set_select('ay', $acad_year)?>>
                  <?= $acad_year?>
                </option>
              <?php endfor ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="payee" class="form-label"><span class="text-danger">*</span>Payer's Name</label>
            <input type="text" name="payee" id="payee" class="form-control form-control-sm">
          </div>
          <div class="row g-3 mb-3">
            <div class="col">
              <label for="amt" class="form-label"><span class="text-danger">*</span>Amount</label>
              <div class="input-group input-group-sm">
                <div class="input-group-text">&#8369;</div>
                <input type="number" name="amt" id="amt" class="form-control form-control-sm">
              </div>
            </div>
            <div class="col">
              <label for="type" class="form-label"><span class="text-danger">*</span>Payment Type</label>
              <select name="type" id="type" class="form-select form-select-sm">
                <option value="" selected disabled>Select Payment Type</option>
                <option value="Cash">Cash</option>
                <option value="Checks">Checks</option>
                <option value="Debit Cards">Debit Cards</option>
                <option value="Credit Cards">Credit Cards</option>
                <option value="Mobile Payment">Mobile Payment</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="remarks" class="form-label">Remarks</label>
            <input type="text" name="remarks" id="remarks" class="form-control form-control-sm">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw me-1"></i>Save</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</main>