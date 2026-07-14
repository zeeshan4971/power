<!-- Share Link Popup -->
<div class="modal fade" id="shareLinkModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content share-modal">

            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <div class="share-title">
                            Share this link with teacher (no login required):
                        </div>

                        <div class="share-link" id="teacherLink">
                            https://powerguard.app/feedback/abc123xyz
                        </div>
                    </div>

                    <button class="btn-copy" onclick="copyTeacherLink()">
                        Copy Link
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
  .share-modal{
    border:2px solid #43ad4c;
    border-radius:18px;
    background:#eefdf4;
}

.share-modal .modal-body{
    padding:25px;
}

.share-title{
    color:#176b35;
    font-size:18px;
    margin-bottom:8px;
}

.share-link{
    color:#176b35;
    font-size:22px;
    word-break:break-all;
}

.btn-copy{
    background:#43ad4c;
    color:#fff;
    border:none;
    border-radius:8px;
    width:160px;
    height:42px;
    font-weight:600;
}

.modal-backdrop.show{
    opacity:.65;
}
</style>

<script>
function copyTeacherLink() {

    const text = document.getElementById('teacherLink').innerText;

    navigator.clipboard.writeText(text).then(() => {

        const btn = document.querySelector('.btn-copy');

        btn.innerHTML = "Copied ✓";

        setTimeout(() => {
            btn.innerHTML = "Copy Link";
        },2000);

    });
}
</script>