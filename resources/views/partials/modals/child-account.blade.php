<!-- Modal -->
<div class="modal fade" id="createChildModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered child-modal">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create Child Account</h5>
        <button type="button" class="btn-close-custom" data-bs-dismiss="modal">×</button>
      </div>

      <div class="modal-body">
        <h6 class="section-title">Student Information</h6>

        <input type="text" class="form-control mb-2" value="Alex Johnson">

        <label class="form-label ms-5">Username</label>
        <input type="text" class="form-control mb-2" value="alex.johnson09">

        <div class="row g-3 mb-2">
          <div class="col-md-5">
            <label class="form-label ms-5">Grade</label>
            <input type="text" class="form-control" value="9th Grade">
          </div>

          <div class="col-md-7">
            <label class="form-label">School</label>
            <input type="text" class="form-control" value="Lincoln High School">
          </div>
        </div>

        <label class="form-label ms-5">Password</label>
        <input type="password" class="form-control mb-4" value="123456789">

        <div class="row g-4">
          <div class="col-md-4">
            <button class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
          </div>

          <div class="col-md-6 offset-md-1">
            <button class="btn-create-child" data-bs-toggle="modal" data-bs-target="#createChildModal">Create Child</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
  .modal-backdrop.show {
    opacity: 1;
    background-color: #1f3f93;
  }

  .child-modal {
    max-width: 720px;
  }

  .child-modal .modal-content {
    border: none;
    border-radius: 0 0 28px 28px;
    overflow: hidden;
  }

  .child-modal .modal-header {
    height: 80px;
    background: #288de3;
    color: white;
    border: none;
    border-radius: 28px;
    justify-content: center;
    position: relative;
  }

  .child-modal .modal-title {
    font-size: 27px;
    font-weight: 800;
  }

  .btn-close-custom {
    position: absolute;
    right: 24px;
    top: 22px;
    width: 38px;
    height: 38px;
    border: none;
    border-radius: 50%;
    background: rgba(255,255,255,0.22);
    color: white;
    font-size: 34px;
    line-height: 30px;
  }

  .child-modal .modal-body {
    padding: 28px 40px 40px;
  }

  .section-title {
    color: #1f3f93;
    font-size: 19px;
    font-weight: 800;
    margin-bottom: 35px;
  }

  .child-modal .form-label {
    color: #667895;
    font-size: 14px;
    margin-bottom: 6px;
  }

  .child-modal .form-control {
    height: 58px;
    border-radius: 14px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #1f3f93;
    font-size: 17px;
    padding: 0 20px;
  }

  .btn-cancel,
  .btn-create-child {
    width: 100%;
    height: 60px;
    border-radius: 13px;
    font-size: 16px;
    font-weight: 800;
  }

  .btn-cancel {
    background: white;
    color: #667895;
    border: 2px solid #e0e7ef;
  }

  .btn-create-child {
    background: #288de3;
    color: white;
    border: none;
  }
</style>