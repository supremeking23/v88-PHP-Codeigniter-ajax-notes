
<div class="modal error-modal"  tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Please fix the following error(s)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul>
            <?= $errors ?>
            </ul>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $.get('notes/index_html', function(res) { 
            $('.error-modal').modal({show:true});
        });
        
        // $('.error-modal').modal('toggle');
    });
</script>