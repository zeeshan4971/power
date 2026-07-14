<!-- Bootstrap Modal Button -->
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#goalModal">
  Add New Goal
</button>

<!-- Modal -->
<div class="modal fade" id="goalModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered goal-modal">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create New Goal</h5>
        <button type="button" class="btn-close-custom" data-bs-dismiss="modal">×</button>
      </div>

      <div class="modal-body">

        <div class="student-mini-card">
          <div class="student-avatar">👱</div>
          <div>
            <div class="student-name">Alex Johnson</div>
            <div class="student-sub">This Week's Goal</div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Goal Title</label>
          <input type="text" class="form-control" value="Complete all homework assignments daily">
        </div>

        <label class="form-label">Category</label>
        <div class="category-row mb-3">
          <button class="category-btn active">📚 Academics</button>
          <button class="category-btn">🕘 Attendance</button>
          <button class="category-btn">🤝 Behavior</button>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Target / Frequency</label>
            <input type="text" class="form-control" value="Every school day this week">
          </div>

          <div class="col-md-6">
            <label class="form-label">Success Criteria</label>
            <input type="text" class="form-control" value="100% completion">
          </div>
        </div>

        <label class="form-label">Goal Preview</label>
        <div class="goal-preview">
          <div class="preview-title">📚 Complete all homework assignments daily</div>
          <div class="preview-sub">Category: Academics • Target: This week</div>
        </div>

        <div class="row g-3 mt-4">
          <div class="col-md-4">
            <button class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
          </div>
          <div class="col-md-5">
            <button class="btn-add-goal">Add This Goal</button>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<style>
  .modal-backdrop.show {
    opacity: 0.75;
    background-color: #173b87;
  }

  .goal-modal {
    max-width: 760px;
  }

  .goal-modal .modal-content {
    border: none;
    border-radius: 0 0 28px 28px;
    overflow: hidden;
  }

  .goal-modal .modal-header {
    height: 80px;
    background: #4a4a4a;
    color: white;
    border: none;
    border-radius: 28px;
    justify-content: center;
    position: relative;
  }

  .goal-modal .modal-title {
    font-size: 26px;
    font-weight: 800;
  }

  .btn-close-custom {
    position: absolute;
    right: 22px;
    top: 22px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background: #777;
    color: white;
    font-size: 34px;
    line-height: 28px;
  }

  .goal-modal .modal-body {
    padding: 20px 40px 30px;
  }

  .student-mini-card {
    height: 60px;
    background: #eef8ff;
    border-radius: 14px;
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 8px 16px;
    margin-bottom: 24px;
  }

  .student-avatar {
    width: 48px;
    height: 48px;
    background: #5aa0f2;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .student-name {
    color: #1f3f93;
    font-size: 18px;
    font-weight: 800;
    line-height: 1.1;
  }

  .student-sub {
    color: #667895;
    font-size: 14px;
  }

  .goal-modal .form-label {
    color: #667895;
    font-size: 15px;
    margin-bottom: 7px;
  }

  .goal-modal .form-control {
    height: 58px;
    border-radius: 13px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #1f3f93;
    font-size: 17px;
    padding: 0 20px;
  }

  .category-row {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .category-btn {
    height: 54px;
    min-width: 142px;
    padding: 0 18px;
    border-radius: 12px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #667895;
    font-size: 15px;
  }

  .category-btn.active {
    border-color: #1688ff;
    color: #1688ff;
    background: #eef6ff;
  }

  .goal-preview {
    min-height: 100px;
    border: 2px solid #43ad4c;
    background: #eefdf4;
    border-radius: 18px;
    padding: 20px 40px;
  }

  .preview-title {
    color: #176b35;
    font-size: 22px;
    margin-bottom: 8px;
  }

  .preview-sub {
    color: #176b35;
    font-size: 15px;
  }

  .btn-cancel,
  .btn-add-goal {
    width: 100%;
    height: 58px;
    border-radius: 13px;
    font-size: 16px;
    font-weight: 800;
  }

  .btn-cancel {
    background: #fff;
    border: 2px solid #e0e7ef;
    color: #667895;
  }

  .btn-add-goal {
    background: #222;
    border: none;
    color: #fff;
  }

  @media (max-width: 768px) {
    .goal-modal .modal-body {
      padding: 25px;
    }

    .category-btn {
      width: 100%;
    }
  }
</style>