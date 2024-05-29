<div class="modal fade" id="deleteModal{{ $id_admin }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Admin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik <strong>Hapus</strong> jika anda ingin melanjutkan.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('admin.data.account.delete_process') }}" method="post">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="id_admin" value="{{ $id_admin }}">
                    <button class="btn btn-primary">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>