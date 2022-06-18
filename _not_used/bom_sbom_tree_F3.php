<?php
  $nav_selected = "BOM";
  $left_buttons = "YES";
  $left_selected = "SBOMTREE";

  include("./index.php");
 ?>

<!--Imports-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treetable/3.2.0/css/jquery.treetable.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treetable/3.2.0/css/jquery.treetable.theme.default.css" />

 <div class="right-content">
    <div class="container" id="container">
      <h3 style = "color: #01B0F1;">BOM --> BOM Tree</h3>
      <a href="#" onclick="$('#bom_treetable').treetable('expandAll'); return false;">Expand all</a>
      <a href="#" onclick="$('#bom_treetable').treetable('collapseAll'); return false;">Collapse all</a>

      <script type="text/javascript">
        //We only use php to pull the rows from the sbom table and store them into an array
        let sbomArray = [];

        <?php
        $sql = "SELECT concat(app_name,concat(' ', app_version)) as app_name, concat(cmp_name,concat(' ', cmp_version)) as cmp_name, request_id from sbom";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "sbomArray.push(", json_encode($row), ");\r\n";
          }
        }else {
          echo "0 results";
        }

        $result->close();
        ?>

        //Build a very nested Map
        //I did this to simulate a tree datastructure w/o actually implementing a tree datastructure (take that, ICS-340)
        let tree = new Map();
        sbomArray.forEach(row => {
          //If the tree doesn't have the app_name, add it
          if(!tree.has(row['app_name'])){
            tree.set(row['app_name'], new Map());
          }

          //if the tree doesn't have the app_id of an app_name, add it
          if(!tree.get(row['app_name']).has(row['cmp_name'])){
            tree.get(row['app_name']).set(row['cmp_name'], new Map());
          }

          //if the tree doesn't have the cmp_name of an app_id of an app_name, add it
          if(!tree.get(row['app_name']).get(row['cmp_name']).has(row['request_id'])){
            tree.get(row['app_name']).get(row['cmp_name']).set(row['request_id'], row);
          }
        });

        //Build a table that the jQuery treetable plugin can understand
        let container = document.getElementById('container');

        let root = document.createElement('table');
        let tbody = document.createElement('tbody');

        root.appendChild(tbody);

        //These three variables keep track of unique id's and parent:child relationships.
        let idCount = 1;
        let app_nameParentId = -1;
        let app_idParentId = -1;


        //Three nested for loops to generate the table and relationships between rows. TC is O(n^2 * log n)..... Gross.

        //Loop over app_name
        tree.forEach((value, key) => {
          let tr = document.createElement('tr');
          tr.setAttribute('data-tt-id', idCount);
          tbody.appendChild(tr);

          let data = document.createElement('td');
          data.innerHTML = key;
          tr.appendChild(data);

          app_nameParentId = idCount++;

          //loop over app_id
          value.forEach((value, key) => {
            tr = document.createElement('tr');
            tr.setAttribute('data-tt-id', idCount);
            tr.setAttribute('data-tt-parent-id', app_nameParentId);
            tbody.appendChild(tr);

            let data = document.createElement('td');
            data.innerHTML = key;
            tr.appendChild(data);

            app_idParentId = idCount++;

            //loop over cmp_name
            value.forEach((value, key) => {
              tr = document.createElement('tr');
              tr.setAttribute('data-tt-id', idCount);
              tr.setAttribute('data-tt-parent-id', app_idParentId);
              tbody.appendChild(tr);

              let request_id = document.createElement('td');
              //data.innerHTML = Object.entries(value);
              request_id.innerHTML = value['request_id'];
              tr.appendChild(request_id);

            });
          });
        });

        root.setAttribute('id', 'bom_treetable');
        container.appendChild(root);


      </script>
    </div>
</div>

<?php include("./footer.php"); ?>
<script>
       //Params for the treetable
       let params = {
          expandable: true,
          clickableNodeNames: true
        };

        //Generate tree table
        $("#bom_treetable").treetable(params);
  </script>
