<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0;">
            <div class="modal-header" style="border-radius: 0;">
                <h5 class="modal-title" id="deleteModalTitle">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimer cet élément ?
            </div>
            <div class="modal-footer" style="border-radius: 0;">
                <button type="button" class="btn btn-secondary text-white" style="border-radius: 0;" data-bs-dismiss="modal">Annuler</button>
                <form class="d-inline" method="post" action="#" id="deleteLink">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger text-white align-baseline" style="box-shadow: none;border-radius: 0;">
                        <i class="fas fa-trash"></i>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let modal = document.getElementById('deleteModal')

    modal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let link = document.getElementById('deleteLink')
        link.setAttribute('action', button.getAttribute('href'))
    })
</script>
