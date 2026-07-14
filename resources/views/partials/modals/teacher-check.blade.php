
<!-- Modal -->
<div class="modal fade" id="teacherRequestModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered teacher-modal">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h4 class="modal-title">Request New Teacher Check-in</h4>

                <button type="button" class="btn-close-custom"
                        data-bs-dismiss="modal">×</button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Student -->
                <div class="student-card">

                    <div class="student-avatar">
                        👱
                    </div>

                    <div>
                        <div class="student-name">
                            Alex Johnson
                        </div>

                        <div class="student-sub">
                            Grade 9 • Requesting teacher pulse check
                        </div>
                    </div>

                </div>

                <h5 class="section-title">
                    Request Details
                </h5>

                <!-- Teacher -->
                <div class="mb-3">
                    <label class="form-label">Select Teacher</label>

                    <select class="form-select">
                        <option>Ms. Rodriguez (Mathematics)</option>
                        <option>Mr. Thompson (Science)</option>
                        <option>Mrs. Wilson (English)</option>
                    </select>
                </div>

                <!-- Message -->
                <div class="mb-3">
                    <label class="form-label">
                        Message for Teacher (Optional)
                    </label>

                    <textarea class="form-control" rows="5">Hi Ms. Rodriguez,

Could you please give a quick update on Alex's focus and participation this week?

Thank you!</textarea>
                </div>

                <!-- Urgency -->
                <label class="form-label">
                    Urgency
                </label>

                <div class="urgency-group mb-4">

                    <button class="urgency-btn normal active">
                        Normal
                    </button>

                    <button class="urgency-btn urgent">
                        Urgent
                    </button>

                </div>

                <!-- Footer Buttons -->
                <div class="row g-4">

                    <div class="col-md-4">
                        <button class="btn-cancel"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>

                    <div class="col-md-5 offset-md-1">
                        <button class="btn-send">
                            Send Request
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<style>
    .modal-backdrop.show{
        opacity:.70;
    }

    .teacher-modal{
        max-width:720px;
    }

    .teacher-modal .modal-content{
        border:none;
        border-radius:0 0 28px 28px;
        overflow:hidden;
    }

    .teacher-modal .modal-header{
        height:78px;
        background:#000;
        color:#fff;
        border:none;
        border-radius:28px;
        justify-content:center;
        position:relative;
    }

    .teacher-modal .modal-title{
        font-size:26px;
        font-weight:800;
    }

    .btn-close-custom{
        position:absolute;
        right:22px;
        top:18px;
        width:40px;
        height:40px;
        border:none;
        border-radius:50%;
        background:#444;
        color:#fff;
        font-size:34px;
        line-height:30px;
    }

    .teacher-modal .modal-body{
        padding:22px 40px 35px;
    }

    .student-card{
        display:flex;
        align-items:center;
        gap:16px;
        background:#f8fbff;
        border:2px solid #dfe7f2;
        border-radius:18px;
        padding:10px 18px;
        margin-bottom:22px;
    }

    .student-avatar{
        width:54px;
        height:54px;
        border-radius:50%;
        background:#000;
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:30px;
    }

    .student-name{
        color:#1f3f93;
        font-size:18px;
        font-weight:700;
    }

    .student-sub{
        color:#667895;
        font-size:15px;
    }

    .section-title{
        color:#1f3f93;
        font-size:19px;
        font-weight:800;
        margin-bottom:18px;
    }

    .form-label{
        color:#667895;
        margin-bottom:8px;
    }

    .form-control,
    .form-select{
        height:56px;
        border-radius:14px;
        border:2px solid #e0e7ef;
        background:#f8fbff;
        color:#1f3f93;
        font-size:17px;
        padding:0 18px;
    }

    textarea.form-control{
        height:130px;
        padding:16px 18px;
        resize:none;
    }

    .urgency-group{
        display:flex;
        gap:18px;
    }

    .urgency-btn{
        width:140px;
        height:50px;
        border-radius:12px;
        background:#fff;
        font-size:17px;
    }

    .normal{
        border:2px solid #1688ff;
        color:#1688ff;
    }

    .normal.active{
        background:#eef6ff;
    }

    .urgent{
        border:2px solid #ff5b5b;
        color:#ff4b4b;
    }

    .btn-cancel,
    .btn-send{
        width:100%;
        height:58px;
        border-radius:14px;
        font-size:18px;
        font-weight:700;
    }

    .btn-cancel{
        background:#fff;
        border:2px solid #dfe7f2;
        color:#667895;
    }

    .btn-send{
        background:#000;
        color:#fff;
        border:none;
    }

    @media(max-width:768px){

        .teacher-modal .modal-body{
            padding:20px;
        }

        .urgency-group{
            flex-direction:column;
        }

        .urgency-btn{
            width:100%;
        }
    }
</style>