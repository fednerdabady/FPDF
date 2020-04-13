<!doctype html>
<html>
    <head>
        <meta charset='uft-8' />
        <title>Example Modal AJAX</title>
        <link rel='stylesheet' href="bootstrap/css/bootstrap.min.css"/>
    </head>

    <body>
        <form class='form form-inline' id='myForm' method='post'>
            <label>Message:</label>
            <input name='msg' type='text' class='form-control' placeholder='Digit your message' />

            <input class='btn btn-sm btn-primary' type='submit' value='Send' />
        </form>
        <h4 class='text-danger' id='myError'>Failure, check your message</h4>

        <div id='myModal' class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-success">Message was received!</h4>
                    </div>

                    <div class="modal-body text-success">
                        <p>Your message: <span id='myMsg'></span></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script src='jquery.min.js'></script>
        <script src='bootstrap/js/bootstrap.min.js'></script>
        <script>
            $(function()
            {
                $('#myError').hide();
                $('#myForm').submit(function(e)
                {

                    $.ajax
                    ({
                        url: 'script.php', 
                        type: 'POST',
                        data:  new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data, textStatus, jqXHR)
                        {
                            if(data != "fail")
                            {
                                $('#myMsg').text(data);
                                $('#myModal').modal('show');
                            }
                            else
                            {
                                $('#myError').show('slow');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                        }          
                    });
                    e.preventDefault();

                });
            });
        </script>
    </body>
</html