<!-- Bootstrap Modal Button -->
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#rewardModal">
  Create New Reward
</button>

<!-- Modal -->
<div class="modal fade" id="rewardModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered reward-modal">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create New Reward</h5>
        <button type="button" class="btn-close-custom" data-bs-dismiss="modal">×</button>
      </div>

      <div class="modal-body">
        <h6 class="section-title">Reward Details</h6>

        <div class="mb-3">
          <label class="form-label">Reward Name</label>
          <input type="text" class="form-control" value="Dinner out at favorite restaurant">
        </div>

        <div class="mb-3">
          <label class="form-label">Condition to Unlock</label>
          <input type="text" class="form-control" value="Complete 100% of weekly goals for 4 weeks">
        </div>

        <label class="form-label">Reward Category</label>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <button class="category-btn active">🍕 Food</button>
          </div>
          <div class="col-md-4">
            <button class="category-btn">🎮 Gaming</button>
          </div>
          <div class="col-md-4">
            <button class="category-btn">🏆 Experience</button>
          </div>
        </div>

        <label class="form-label">Preview</label>
        <div class="preview-box">
          <div class="preview-title">🍕 Dinner out at favorite restaurant</div>
          <div class="preview-text">If Alex completes all goals this month</div>
        </div>

        <div class="row g-4 mt-4">
          <div class="col-md-4">
            <button class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
          </div>
          <div class="col-md-6 offset-md-1">
            <button class="btn-create">Create Reward</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<style>
  .modal-backdrop.show {
    opacity: 0.7;
  }

  .reward-modal {
    max-width: 720px;
  }

  .reward-modal .modal-content {
    border: none;
    border-radius: 0 0 28px 28px;
    overflow: hidden;
  }

  .reward-modal .modal-header {
    background: #000;
    color: #fff;
    height: 80px;
    border: none;
    border-radius: 28px;
    justify-content: center;
    position: relative;
  }

  .reward-modal .modal-title {
    font-size: 26px;
    font-weight: 800;
  }

  .btn-close-custom {
    position: absolute;
    right: 22px;
    top: 22px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: none;
    background: #444;
    color: #fff;
    font-size: 34px;
    line-height: 30px;
  }

  .reward-modal .modal-body {
    padding: 20px 50px 22px;
  }

  .section-title {
    color: #1f3f93;
    font-size: 19px;
    font-weight: 800;
    margin-bottom: 22px;
  }

  .reward-modal .form-label {
    color: #667895;
    font-size: 15px;
    margin-bottom: 8px;
  }

  .reward-modal .form-control {
    height: 60px;
    border-radius: 13px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #1f3f93;
    font-size: 17px;
    padding: 0 20px;
  }

  .category-btn {
    width: 100%;
    height: 54px;
    border-radius: 12px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #667895;
    font-size: 16px;
  }

  .category-btn.active {
    border-color: #1688ff;
    color: #1688ff;
    background: #eef6ff;
  }

  .preview-box {
    min-height: 110px;
    border: 2px solid #ffc400;
    background: #fffbe8;
    border-radius: 20px;
    padding: 22px 50px;
  }

  .preview-title {
    color: #d88400;
    font-size: 22px;
    margin-bottom: 4px;
  }

  .preview-text {
    color: #9b5d00;
    font-size: 15px;
  }

  .btn-cancel,
  .btn-create {
    width: 100%;
    height: 60px;
    border-radius: 13px;
    font-size: 16px;
    font-weight: 800;
  }

  .btn-cancel {
    background: #fff;
    border: 2px solid #e0e7ef;
    color: #667895;
  }

  .btn-create {
    background: #000;
    border: none;
    color: #fff;
  }
</style>