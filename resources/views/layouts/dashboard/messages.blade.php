@if(isset($errors) && count($errors) > 0)
    <?php $messages = ""; ?>
    @foreach($errors->all() as $error)
        <?php $messages .= $error."<br>"; ?>
    @endforeach
    <script>
        $(document).ready(function(){
            messageNotif("{!!$messages!!}", 'error', 'right');
        });
    </script>
@endif

@if((session('success')))
    <script>
        $(document).ready(function(){
            messageNotif("{{session('success')}}", 'success', 'right');
        });
    </script>
@endif

@if((session('error')))
    <script>
        $(document).ready(function(){
            messageNotif("{{session('error')}}", 'error', 'right');
        });
    </script>
@endif