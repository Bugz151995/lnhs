<!-- add track and strand form -->
<section class="border bg-white m-4 p-0">
  <h5 for="" class="w-100 bg-light p-3 text-center">Schedule</h5>

  <!-- form -->
  <div class="px-4 py-2 pb-4">
    <?= form_open()?> 
      <div class="row row-cols-1 row-cols-lg-3 mb-2">
        <div class="col form-group">
          <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
          <input type="text" name="semester" id="semester" class="form-control disabled" value="1st Semester">
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
      <div class="row row-cols-1 row-cols-sm-2 g-3">
        <div class="col form-group">
          <label for="track" class="form-label"><span class="text-danger">*</span> Track</label>
          <select name="track" id="" class="form-select" >
            <option value="" selected disabled> Select Track Here</option>
            <option value="academic">Academic Track</option>
            <option value="tvl">Technical-Vocational-Livelihood (TVL) Track</option>
            <option value="sports">Sports Track</option>
            <option value="art and desig">Arts and Design Track</option>
          </select>
        </div>
        <div class="col form-group">
          <label for="strand" class="form-label"><span class="text-danger">*</span> Strand</label>
          <select name="strand" class="form-select">
              <option value="" selected disabled>Select Strand</option>
              <option value="GAS">GAS</option>
              <option value="ABM">ABM</option>
              <option value="STEM">STEM</option>
              <option value="HUMMS">HUMMS</option>
          </select>
        </div>
      </div>

      <!-- add subject table -->
      <table class="table table-borderless table-light border table-striped mt-4">
        <thead>
          <tr class="text-center">
            <th>Subject Code</th>
            <th>Start Time</th>
            <th>Dismiss Time</th>
            <th>Day</th>
            <th>Section</th>
            <th>Teacher</th>
            <th>Room</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control" value="OC11.1" disabled></td>
            <td><input type="time" class="form-control" placeholder="Start Time Here..."></td>
            <td><input type="time" class="form-control" placeholder="Dismiss Time Here..."></td>
            <td><input type="text" class="form-control" placeholder="Day Here..."></td>
            <td><input type="text" class="form-control" placeholder="Section Here..."></td>
            <td><input type="text" class="form-control" placeholder="Teacher Here..."></td>
            <td><input type="text" class="form-control" placeholder="Room Here..."></td>
          </tr>
        </tbody>                    
      </table>  
      <hr>
      <div class="d-flex justify-content-end">
        <button class="btn btn-outline-primary"><i class="far fa-save"></i> Save</button>
      </div>    
    <?= form_close()?>
  </div>
</section>

<!-- view sublect schedule-->
<section class="border bg-white m-4 mt-5 p-0">
  <h5 for="" class="w-100 bg-light p-3 text-center">View Schedule</h5>
  <div class="px-4 py-2 pb-4">
    <table class="table table-borderless table-striped border">
      <thead class="text-center">
        <tr>
          <th>Track</th>
          <th>Strand</th>
          <th>Section</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="text-center align-middle">
        <tr>
          <td>Academic</td>
          <td>ABM</td>
          <td>ABM-11</td>
          <td class="align-middle text-center">
            <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editTrackStrands"><i class="far fa-edit"></i> Edit</a>
          </td>
        </tr>
        <tr>
          <td>Academic</td>
          <td>ABM</td>
          <td>ABM-11</td>
          <td class="align-middle text-center">
            <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editTrackStrands"><i class="far fa-edit"></i> Edit</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<!-- edit schedule modal -->
<div class="modal fade" id="editTrackStrands" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editTrackStrandsLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white px-4">
        <h5 class="modal-title" id="editTrackStrandsLabel"><i class="far fa-edit fa-3x"></i> Edit Course Schedule </h5>
        <button type="button" class="btn-close bg-white me-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="px-4 py-2 ">
          <?= form_open()?> 
            <div class="row row-cols-1 row-cols-lg-3 mb-2">
              <div class="col form-group">
                <label for="semester" class="form-label"><span class="text-danger">*</span> Semester</label>
                <input type="text" name="semester" id="semester" disabled class="form-control disabled" value="1st Semester">
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
            <div class="row row-cols-1 row-cols-sm-2 g-3">
              <div class="col form-group">
                <label for="track" class="form-label"><span class="text-danger">*</span> Track</label>
                <select name="track" id="" class="form-select" >
                  <option value="" selected disabled> Select Track Here</option>
                  <option value="academic">Academic Track</option>
                  <option value="tvl">Technical-Vocational-Livelihood (TVL) Track</option>
                  <option value="sports">Sports Track</option>
                  <option value="art and desig">Arts and Design Track</option>
                </select>
              </div>
              <div class="col form-group">
                <label for="strand" class="form-label"><span class="text-danger">*</span> Strand</label>
                <select name="strand" class="form-select">
                    <option value="" selected disabled>Select Strand</option>
                    <option value="GAS">GAS</option>
                    <option value="ABM">ABM</option>
                    <option value="STEM">STEM</option>
                    <option value="HUMMS">HUMMS</option>
                </select>
              </div>
            </div>

            <!-- add subject table -->
            <table class="table table-borderless table-light border table-striped mt-4">
              <thead>
                <tr class="text-center">
                  <th>Subject Code</th>
                  <th>Start Time</th>
                  <th>Dismiss Time</th>
                  <th>Day</th>
                  <th>Section</th>
                  <th>Teacher</th>
                  <th>Room</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><input type="text" class="form-control" value="OC11.1" disabled></td>
                  <td><input type="time" class="form-control" placeholder="Start Time Here..."></td>
                  <td><input type="time" class="form-control" placeholder="Dismiss Time Here..."></td>
                  <td><input type="text" class="form-control" placeholder="Day Here..."></td>
                  <td><input type="text" class="form-control" placeholder="Section Here..."></td>
                  <td><input type="text" class="form-control" placeholder="Teacher Here..."></td>
                  <td><input type="text" class="form-control" placeholder="Room Here..."></td>
                </tr>
              </tbody>                    
            </table>     
          <?= form_close()?>
        </div>
      </div>
      <div class="modal-footer">
        <div type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save fa-fw"></i> Save</button>
      </div>
    </div>
  </div>
</div>