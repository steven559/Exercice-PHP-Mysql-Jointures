
<html>
<head>
    <script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
    <script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>
</head>
<body>
<div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/"></a></div>
</body>
</html>
<head>
    <style>
        #myChart{
            color:white;
        }
        .tt {

            border: solid black 1px;
        }

        th {
            color: grey;
            background-color: black;
            width: 10%;
            border: solid black 1px;
        }

        td {
            justify-content: center;
            text-align: center;
            width: 10%;
            padding: 2%;
            border: solid black 2px;
            background-color: lightgray;
        }

        table {

            text-shadow: -1px -1px #eee, 1px 1px black, black;
            font-family: "Segoe print", Arial, Helvetica, sans-serif;
            color: black;

            font-weight: lighter;
            -moz-box-shadow: 2px 2px 6px #888;
            -webkit-box-shadow: 2px 2px 6px #888;
            box-shadow: 2px 2px 6px #888;
            text-align: center;

            line-height: 19px;
            margin-left: 25%;
        }

        h1 {

            font-size: 24px;
            text-shadow: -1px -1px #eee, 1px 1px #888, -3px 0 4px #000;
            font-family: "Segoe print", Arial, Helvetica, sans-serif;
            color: #ccc;
            padding: 16px;
            font-weight: lighter;
            -moz-box-shadow: 2px 2px 6px #888;
            -webkit-box-shadow: 2px 2px 6px #888;
            box-shadow: 2px 2px 6px #888;
            text-align: center;
            margin-left: 38%;
            display: inline;
            width: 50%;
            line-height: 122px;
        }

    </style>

</head>



<?php
/**
 * Created by PhpStorm.
 * User: sstienface
 * Date: 04/12/2018
 * Time: 11:25
 */

$servername= "localhost";
$username="id7331201_steven";
$password="";
$dbname ="id7331201_base";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} else {

    $conn->select_db($dbname);
}

function affiche()
{
    global $conn;

    $sql = "SELECT *  from eleves,eleves_info";

    $result = $conn->query($sql);

    echo "<th>prenom</th><th>nom</th><th>age</th><th>id</th>";

    while ($row = $result->fetch_assoc()) {

        ?>

        <tr>


            <td class="tt"><?= $row['prenom']; ?></td>

            <td class="tt"><?= $row['nom']; ?></td>
            <td class="tt"><?= $row['age']; ?></td>
            <td class="tt"><?= $row['id']; ?></td>


        </tr>

        <?php
    }
}


echo "<table>";
affiche();
echo "<table>";



$js = "SELECT eleves_competences.niveau_ae,eleves_competences.niveau,eleves_competences.competences_id,competences.titre 
       from eleves_competences, competences,eleves WHERE eleves_id = 1 
       and competences.id = eleves_competences.competences_id group by eleves_competences.id ";





$result = $conn->query($js);




$competences = array();





while ($row = $result->fetch_assoc() ) {


    $i = $row['competences_id'];
    $competences[$i] = array("niveau"=>$row['niveau'],"niveau_ae"=>$row['niveau_ae'],'titre'=>$row['titre']);
    $i++;


}



    ?>


    <?php


?>

<input type="hidden" id="truc" value ="<?php echo $mavar; ?>">

<script>
var JS=document.getElementById('truc');
    var myConfig = {
        type : 'radar',
        plot : {
            aspect : 'area',
            animation: {
                effect:3,
                sequence:1,
                speed:700
            }
        },
        scaleV : {
            visible : false
        },
        scaleK : {
            values : '0:5:1',
            labels : ['<?= $competences[1]['titre']?>','<?= $competences[4]['titre']?>','<?= $competences[5]['titre']?>','\'<?= $competences[3]['titre']?>', '<?= $competences[2]['titre']?>', '<?= $competences[6]['titre']?>' ],
            item : {
                fontColor : '#607D8B',
                backgroundColor : "white",
                borderColor : "#aeaeae",
                borderWidth : 1,
                padding : '5 10',
                borderRadius : 10
            },
            refLine : {
                lineColor : '#c10000'
            },
            tick : {
                lineColor : '#59869c',
                lineWidth : 2,
                lineStyle : 'dotted',
                size : 20
            },
            guide : {
                lineColor : "#607D8B",
                lineStyle : 'solid',
                alpha : 0.3,
                backgroundColor : "#c5c5c5 #718eb4"
            }
        },
        series : [
            {
                values : [<?= $competences[1]['niveau_ae'] ?>, <?= $competences[4]['niveau_ae'] ?>, <?= $competences[5]['niveau_ae'] ?>,<?= $competences[3]['niveau_ae']; ?>, <?= $competences[2]['niveau_ae']; ?>, <?= $competences[6]['niveau_ae']; ?>],
                text:'farm'
            },
            {
                values : [<?= $competences[1]['niveau'] ?>, <?= $competences[4]['niveau'] ?>,<?= $competences[5]['niveau'] ?>, <?= $competences[3]['niveau'] ?>, <?= $competences[2]['niveau'] ?>, <?= $competences[6]['niveau'] ?>],
                lineColor : '#53a534',
                backgroundColor : '#689F38'
            }
        ]
    };

    zingchart.render({
        id : 'myChart',
        data : myConfig,
        height: '100%',
        width: '100%'
    });

</script>

