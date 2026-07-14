<!-- Modal -->
<div class="modal fade" id="pulseCheckModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered pulse-modal">
    <div class="modal-content">

      <div class="modal-body">
        <h2 class="modal-title-custom">Quick Student Pulse Check</h2>
        <p class="modal-subtitle">Takes less than 30 seconds • Alex Johnson</p>

        <div class="student-box">
          <div class="student-avatar">👱</div>
          <div>
            <div class="student-name">Alex Johnson</div>
            <div class="student-info">Grade 9 • Week of May 25, 2026</div>
          </div>
        </div>

        <h5 class="field-title">Engagement in Class</h5>
        <div class="btn-group-custom mb-4">
          <button class="option-btn green active">Good</button>
          <button class="option-btn orange active">Average</button>
          <button class="option-btn light">Needs Work</button>
        </div>

        <h5 class="field-title">Work Completion</h5>
        <div class="btn-group-custom mb-4">
          <button class="option-btn green active large">Mostly Completed</button>
          <button class="option-btn light">Partial</button>
        </div>

        <h5 class="field-title">Quick Comment (Optional)</h5>
        <textarea class="comment-box">Needs better focus during independent work time. Strong in group discussions.</textarea>

        <button class="submit-btn">Submit Feedback</button>
      </div>

    </div>
  </div>
</div>

<style>
  .modal-backdrop.show {
    opacity: 0.65;
  }

  .pulse-modal {
    max-width: 890px;
  }

  .pulse-modal .modal-content {
    border-radius: 28px;
    border: 3px solid #e0e7ef;
    overflow: hidden;
  }

  .pulse-modal .modal-body {
    padding: 24px 58px 18px;
  }

  .modal-title-custom {
    color: #1f3f93;
    font-size: 27px;
    font-weight: 800;
    margin-bottom: 5px;
  }

  .modal-subtitle {
    color: #667895;
    font-size: 16px;
    margin-bottom: 26px;
  }

  .student-box {
    height: 82px;
    border: 2px solid #000;
    border-radius: 16px;
    background: #b7b7b7;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 10px 18px;
    margin-bottom: 22px;
  }

  .student-avatar {
    width: 64px;
    height: 64px;
    background: #000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 31px;
  }

  .student-name {
    color: #1f3f93;
    font-size: 21px;
    font-weight: 800;
    line-height: 1.1;
  }

  .student-info {
    color: #667895;
    font-size: 16px;
    margin-top: 5px;
  }

  .field-title {
    color: #1f3f93;
    font-size: 19px;
    font-weight: 800;
    margin-bottom: 14px;
  }

  .btn-group-custom {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
  }

  .option-btn {
    height: 55px;
    min-width: 125px;
    padding: 0 22px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    border: 3px solid transparent;
  }

  .option-btn.large {
    min-width: 168px;
  }

  .option-btn.green {
    background: #43ad4c;
    color: white;
  }

  .option-btn.orange {
    background: #ff8c00;
    color: white;
  }

  .option-btn.light {
    background: #f8fbff;
    color: #667895;
    border-color: #e0e7ef;
  }

  .comment-box {
    width: 100%;
    height: 132px;
    border-radius: 16px;
    border: 2px solid #e0e7ef;
    background: #f8fbff;
    color: #667895;
    font-size: 16px;
    padding: 24px 30px;
    resize: none;
    margin-bottom: 38px;
  }

  .submit-btn {
    width: 100%;
    height: 68px;
    border-radius: 15px;
    background: #000;
    color: white;
    border: none;
    font-size: 20px;
    font-weight: 800;
  }

  @media (max-width: 768px) {
    .pulse-modal .modal-body {
      padding: 25px;
    }

    .option-btn,
    .option-btn.large {
      width: 100%;
    }

    .student-box {
      height: auto;
    }
  }
</style>