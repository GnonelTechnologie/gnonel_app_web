<?php
//$types=Illuminate\Support\Facades\DB::table('type')->get();

?>
 <form action="{{route('admins.store')}}" method="post" file="true" enctype="multipart/form-data"><div class="modal-header">
        <button type="button" style="color: #4cae4c" class="close" data-dismiss="modal">&times;</button>
        <h2>Nouveau admin</h2>
    </div>
    <div class="modal-body">

        <input type="hidden" name="_token" value="{{csrf_token()}}" required class="form-control">
        <label>Email</label>
        <input class="form-control" name="email" type="email"> <br>
        <label>Mot de passe</label>
        <input class="form-control" name="password" type="password"> <br>
       <!-- <select name="admin" class="form form-control">
       
        </select>-->
    </div>
    <div class="modal-footer">
        <br><input type="submit" class="btn btn-success" value="Enregistrer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
    </div></form>
