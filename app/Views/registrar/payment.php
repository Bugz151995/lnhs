<!-- payment management -->
<section class="border bg-white m-4 p-0">
  <h5 for="" class="w-100 bg-light p-3 text-center">Payment Management</h5>

  <!-- form -->
  <div class="px-4 py-2 pb-4">
    <?= form_open()?> 
      <div class="row row-cols-1 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
        <div class="col form-group">
          <label for="pymntStatus" class="form-label"><span class="text-danger">*</span>Date</label>
          <input type="date" class="form-control " placeholder="">
        </div>
        <div class="col form-group">
          <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
          <select name="semester" id="" class="form-select ">
            <option value="" selected disabled>Select semester</option>
            <option value="1">1st Semester</option>
            <option value="2">2nd Semester</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="acadyear" class="form-label"><span class="text-danger">*</span> Academic Year</label>
          <div class="input-group d-flex gap-3 align-items-center">
            <input type="number" name="acadyear" id="acadyear" class="form-control" placeholder="YYYY">
            <span> - </span>
            <input type="number" name="acadyear" id="acadyear" class="form-control" placeholder="YYYY">
          </div>
        </div>
      </div>
      <hr>

      <div class="row row-cols-1 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
        <div class="col form-group">
          <label for="track" class="form-label"><span class="text-danger">*</span> Track</label>
          <select name="track" id="" class="form-select " >
            <option value="" selected disabled> Select Track Here</option>
              <option value="academic">Academic Track</option>
              <option value="tvl">Technical-Vocational-Livelihood (TVL) Track</option>
              <option value="sports">Sports Track</option>
              <option value="art and desig">Arts and Design Track</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="strand" class="form-label"><span class="text-danger">*</span> Strand</label>
          <select name="strand" class="form-select ">
              <option value="" selected disabled>Select Strand</option>
              <option value="GAS">GAS</option>
              <option value="ABM">ABM</option>
              <option value="STEM">STEM</option>
              <option value="HUMMS">HUMMS</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="section" class="form-label"><span class="text-danger">*</span> Section</label>
          <select name="strand" class="form-select ">
              <option value="" selected disabled>Select Section</option>
              <option value="ABM-11A">ABM-11A</option>
              <option value="ABM-11A">ABM-11A</option>
              <option value="ABM-11A">ABM-11A</option>
              <option value="ABM-11A">ABM-11A</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="studentNme" class="form-label"><span class="text-danger">*</span> Student Name</label>
          <select name="studentNme" class="form-select ">
              <option value="" selected disabled>Select Student Name</option>
              <option value="Garcia">Garcia, Jake Reno.</option>
              <option value="Garcia, Jake Reno.">Garcia, Jake Reno.</option>
              <option value="Garcia, Jake Reno.">Garcia, Jake Reno.</option>
              <option value="Garcia, Jake Reno.">Garcia, Jake Reno.</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="voucher" class="form-label">ESC Garantee's</label>
            <div class="input-group-text ">
              <input type="checkbox" aria-label="Checkbox for following text input" value="ESC Garantee's">
            </div>
        </div>   
      </div>
      <hr>

      <div class="row row-cols-1 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
        <div class="col form-group">
          <label for="payersNme" class="form-label"><span class="text-danger">*</span>Payer's Name</label>
          <input type="text" name="payersNme" class="form-control " placeholder="Payer's name here...">
        </div>
        <div class="col form-group">
          <label for="amount" class="form-label"><span class="text-danger">*</span> Amount</label>
          <div class="input-group">
            <div class="input-group-text">P</div>
            <input type="number" name="amount" class="form-control " placeholder="Input Amount here...">
          </div>
        </div>
        <div class="col form-group">
          <label for="pymntType" class="form-label"><span class="text-danger">*</span>Payment Type</label>
          <select name="pymntType" class="form-select ">
              <option value="" selected disabled>Select Payment Type</option>
              <option value="Cash">Cash</option>
              <option value="Checks">Checks</option>
              <option value="Credit Card">Credit Card</option>
              <option value="Debit cards">Debit Cards</option>
              <option value="Mobile payments">Mobile payments</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="pymntStatus" class="form-label"><span class="text-danger">*</span>Payment Status</label>
          <select name="pymntStatus" class="form-select ">
              <option value="" selected disabled>Select Payment Status</option>
              <option value="Full Payement">Full Payment</option>
              <option value="Partial Payment">Partial Payment</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="remarks" class="form-label"><span class="text-danger">*</span>Remarks</label>
          <input type="text" name="remarks" id="remarks" class="form-control " placeholder="Remarks here...">
        </div>
      </div>
      <hr>
      
      <div class="d-flex justify-content-end gap-3">
        <button type="submit" class="btn btn-outline-primary"> <i class="far fa-save "></i>&nbspSave</button>
        <button type="button" class="btn btn-outline-secondary"> <i class="fas fa-redo"></i>&nbspReset</button>
      </div>
    <?= form_close()?>
  </div>
</section>

<!-- view payment reports -->
<section class="border bg-white m-4 mt-5 p-0">
  <h5 for="" class="w-100 bg-light p-3 text-center">Payment Reports</h5>
  <?= form_open()?>
    <div class="d-flex p-4">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </div>
  <?= form_close()?>
  <div class="px-4 py-2 pb-4 table-responsive">
    <table class="table table-borderless table-striped border">
      <thead class="text-center">
        <tr>
          <th>Student ID</th>
          <th>Section</th>
          <th>Payment Type</th>
          <th>Payment Status</th>
          <th>Amount</th>
          <th>Voucher</th>
          <th>Date</th>
          <th>Semester</th>
          <th>Remarks</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="text-center align-middle">
        <?php for ($i=0; $i < 10; $i++) :?>
        <tr>
          <td>201210239</td>
          <td>ABM-11A</td>
          <td>Cash</td>
          <td>Fully Paid</td>
          <td>&#8369;2,000</td>
          <td class="text-warning">
            <?=
              ($i % 2 == 0) ? '<i class="fas fa-certificate fa-2x"></i>' : '';
            ?>
          </td>
          <td>08/20/2021</td>
          <td>1st Semester</td>
          <td></td>
          <td class="align-middle text-center">
            <a href="#" class="btn  btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editTrackStrands"><i class="far fa-edit"></i> Edit</a>
          </td>
        </tr>
        <?php endfor?>
      </tbody>
    </table>
  </div>
</section>

<!-- edit Patment modal -->
<div class="modal fade" id="editTrackStrands" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTrackStrandsLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white px-4">
        <h5 class="modal-title" id="editTrackStrandsLabel"><i class="far fa-edit fa-3x"></i> Edit Payment</h5>
        <button type="button" class="btn-close bg-white me-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="px-4 py-2 ">
          <?= form_open()?> 
            <div class="row row-cols-1 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
              <div class="col form-group">
                <label for="pymntStatus" class="form-label"><span class="text-danger">*</span>Date</label>
                <input type="date" class="form-control " placeholder="">
              </div>
              <div class="col form-group">
                <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
                <select name="semester" id="" class="form-select ">
                  <option value="" selected disabled>Select semester</option>
                  <option value="1">1st Semester</option>
                  <option value="2">2nd Semester</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="acadyear" class="form-label"><span class="text-danger">*</span> Academic Year</label>
                <div class="input-group d-flex gap-3 align-items-center">
                  <input type="number" name="acadyear" id="acadyear" class="form-control" placeholder="YYYY">
                  <span> - </span>
                  <input type="number" name="acadyear" id="acadyear" class="form-control" placeholder="YYYY">
                </div>
              </div>
            </div>
            <hr>

            <div class="row row-cols-1 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
              <div class="col form-group">
                <label for="track" class="form-label"><span class="text-danger">*</span> Track</label>
                <select name="track" id="" class="form-select " >
                  <option value="" selected disabled> Select Track Here</option>
                    <option value="academic">Academic Track</option>
                    <option value="tvl">Technical-Vocational-Livelihood (TVL) Track</option>
                    <option value="sports">Sports Track</option>
                    <option value="art and desig">Arts and Design Track</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="strand" class="form-label"><span class="text-danger">*</span> Strand</label>
                <select name="strand" class="form-select ">
                    <option value="" selected disabled>Select Strand</option>
                    <option value="GAS">GAS</option>
                    <option value="ABM">ABM</option>
                    <option value="STEM">STEM</option>
                    <option value="HUMMS">HUMMS</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="section" class="form-label"><span class="text-danger">*</span> Section</label>
                <select name="strand" class="form-select ">
                    <option value="" selected disabled>Select Section</option>
                    <option value="ABM-11A">ABM-11A</option>
                    <option value="ABM-11A">ABM-11A</option>
                    <option value="ABM-11A">ABM-11A</option>
                    <option value="ABM-11A">ABM-11A</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="studentNme" class="form-label"><span class="text-danger">*</span> Student Name</label>
                <select name="studentNme" class="form-select ">
                    <option value="" selected disabled>Select Student Name</option>
                    <option value="Garcia">Garcia, Jake Reno.</option>
                    <option value="Garcia, Jake Reno.">Garcia, Jake Reno.</option>
                    <option value="Garcia, Jake Reno.">Garcia, Jake Reno.</option>
                    <option value="Garcia, Jake Reno.">Garcia, Jake Reno.</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="voucher" class="form-label">ESC Garantee's</label>
                  <div class="input-group-text ">
                    <input type="checkbox" aria-label="Checkbox for following text input" value="ESC Garantee's">
                  </div>
              </div>   
            </div>
            <hr>

            <div class="row row-cols-1 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-lg-4 g-2 px-3">
              <div class="col form-group">
                <label for="payersNme" class="form-label"><span class="text-danger">*</span>Payer's Name</label>
                <input type="text" name="payersNme" class="form-control " placeholder="Payer's name here...">
              </div>
              <div class="col form-group">
                <label for="amount" class="form-label"><span class="text-danger">*</span> Amount</label>
                <div class="input-group">
                  <div class="input-group-text">P</div>
                  <input type="number" name="amount" class="form-control " placeholder="Input Amount here...">
                </div>
              </div>
              <div class="col form-group">
                <label for="pymntType" class="form-label"><span class="text-danger">*</span>Payment Type</label>
                <select name="pymntType" class="form-select ">
                    <option value="" selected disabled>Select Payment Type</option>
                    <option value="Cash">Cash</option>
                    <option value="Checks">Checks</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit cards">Debit Cards</option>
                    <option value="Mobile payments">Mobile payments</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="pymntStatus" class="form-label"><span class="text-danger">*</span>Payment Status</label>
                <select name="pymntStatus" class="form-select ">
                    <option value="" selected disabled>Select Payment Status</option>
                    <option value="Full Payement">Full Payement</option>
                    <option value="Partial Payment">Partial Payment</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="remarks" class="form-label"><span class="text-danger">*</span>Remarks</label>
                <input type="text" name="remarks" id="remarks" class="form-control " placeholder="Remarks here...">
              </div>
            </div>
          <?= form_close()?>
        </div>
      </div>
      <div class="modal-footer mt-3">
        <div class="mt-4 px-3 d-grid gap-2 d-md-flex justify-content-md-end mb-3">
          <button type="button" class="btn btn-primary  ">Save</button>
          <button type="button" class="btn btn-secondary  ">Reset</button>
        </div>
      </div>
    </div>
  </div>
</div>