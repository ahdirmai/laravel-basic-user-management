<section>
    <div class="text-danger">
        <p class="mb-4">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before
            deleting your account, please download any data or information that you wish to retain.
        </p>

        <button class="btn btn-danger btn-user btn-block" data-toggle="modal" data-target="#confirmDeletionModal">
            Delete Account
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmDeletionModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="confirmDeletionModalLabel">
                            Delete Account
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h6 class="text-gray-900">
                            Are you sure you want to delete your account?
                        </h6>

                        <p class="text-muted">
                            Once your account is deleted, all of its resources and data will be permanently
                            deleted. Please enter your password to confirm you would like to permanently delete your
                            account.
                        </p>

                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-user"
                                placeholder="Enter your password" />
                            @error('password', 'userDeletion')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>