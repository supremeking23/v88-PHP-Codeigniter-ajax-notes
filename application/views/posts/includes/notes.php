<?php foreach($notes as $note): ?>
    <div class="col-md-4 mt-4">
        <div class="note">
                <!-- <h2><?= $note["title"];?></h2>
                <?= $note["description"];?> -->

                <form action="notes/edit_title"  method="POST" class="edit-form-title">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" value="<?= $note["title"];?>" placeholder="Title..." aria-describedby="title" >
                    </div>
                    <input type="hidden" name="note_id" value="<?= $note["id"] ?>">
                    
                </form>

                <form action="notes/edit_description"  method="POST" class="edit-form-description">

                    <div class="form-group">
                        <textarea class="form-control" name="note" placeholder="Take a note..." id="note" rows="3"><?= $note["description"];?>
                        </textarea>
                    </div>
                    <input type="hidden" name="note_id" value="<?= $note["id"] ?>">
                </form>

                <form action="notes/delete" method="POST" class="delete-form">
                    <input type="hidden" name="note_id" value="<?= $note["id"] ?>">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    <input type="hidden" name="note_id" value="<?= $note["id"] ?>">
                </form>
            </div>
    </div>
<?php endforeach; ?>

    <script>
        $(document).ready(function(){
            $("form.delete-form").submit(function(){
                console.log($(this).serialize());
                $.post($(this).attr('action'), $(this).serialize(), function(res) {
                    $('.notes').html(res);
                    
                    $(".note-alert").html("Note has been deleted successfully");
                    $(".note-alert").toggle()
                    $(".alert").addClass("alert-primary");
                    setTimeout(() => {
                        $(".note-alert").toggle();
                    }, 2500)
                    
                });

                return false;
            });


            // https://stackoverflow.com/questions/15054753/textarea-not-responding-to-blur-with-jquery
            // $(document).on('blur', '.note', function () {
            //     // console.log($(this).children(".edit-form-title").serialize());
            //     let data = $(this).children(".edit-form-title").serialize();
            //     $.post($(".edit-form-title").attr('action'), data , function(res) {
            //         $('.notes').html(res);
            //     });
            //     console.log($(this));
            
            // });

            $(document).on('blur', ".edit-form-title", function () {
                $.post($(this).attr('action'), $(this).serialize() , function(res) {
                    $('.notes').html(res);
                    
                });
                console.log($(this));
            });
 
            $(document).on('blur', ".edit-form-description", function () {
                $.post($(this).attr('action'), $(this).serialize() , function(res) {
                    console.log(res);
                    $('.notes').html(res);
                  
                });
                console.log($(this));
            });
        })
    </script>