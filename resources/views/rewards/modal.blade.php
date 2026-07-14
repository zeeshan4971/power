<div class="modal fade" id="rewardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered reward-modal">
        <form class="modal-content" method="POST" action="{{ route('rewards.store') }}" id="rewardCreateForm">
            @csrf
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Create New Reward</h4>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal" type="button"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="student_id" value="{{ $student?->id }}">
                <input type="hidden" name="category" id="rewardCategory" value="Food">

                <label class="form-label">Reward Name</label>
                <input class="form-control mb-3" name="name" id="rewardName" value="{{ old('name', 'Dinner out at favorite restaurant') }}" required>

                <label class="form-label">Condition to Unlock</label>
                <input class="form-control mb-3" name="condition" id="rewardCondition" value="{{ old('condition', 'Complete 100% of weekly goals for 4 weeks') }}">

                <label class="form-label">Reward Category</label>
                <div class="row g-3 mb-3 reward-category-options">
                    <div class="col-md-4"><button type="button" class="category-btn active" data-reward-category="Food"><span aria-hidden="true">&#127829;</span> Food</button></div>
                    <div class="col-md-4"><button type="button" class="category-btn" data-reward-category="Gaming"><span aria-hidden="true">&#127918;</span> Gaming</button></div>
                    <div class="col-md-4"><button type="button" class="category-btn" data-reward-category="Experience"><span aria-hidden="true">&#127942;</span> Experience</button></div>
                </div>

                <label class="form-label">Preview</label>
                <div class="reward-preview">
                    <strong id="rewardPreviewTitle">&#127829; Dinner out at favorite restaurant</strong>
                    <small id="rewardPreviewCondition">Complete 100% of weekly goals for 4 weeks</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-dark" type="submit">Create Reward</button>
            </div>
        </form>
    </div>
</div>
