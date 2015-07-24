<html>
<head>

</head>

<body>

    <h4>Hi,</h4>

<div>
    <p><strong><?=ucfirst($res->firstname)." ".$res->lastname?></strong> Share His <?=$res->note_type?> ,</p>
    <p><strong><?=$res->note_type?> Subject :</strong> <?=$res->subject?> </p>
    <p><strong>Description :</strong> <?=$res->description?></p>
</div>

</body>

</html>