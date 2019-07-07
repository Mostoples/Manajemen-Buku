</div>
</div>
<!-- arahkan url ke direktori 'assets' -->
<script src="<?php echo base_url();?>assets/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      
      <!-- arahkan url ke direktori 'assets' -->
      <script src="<?php echo base_url();?>assets/bootstrap.bundle.min.js.download" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

      	<!-- arahkan url ke direktori 'assets' -->
        <script src="<?php echo base_url();?>assets/feather.min.js.download"></script>
        <script src="<?php echo base_url();?>assets/Chart.min.js.download"></script>
        

        <script>
		  /* globals Chart:false, feather:false */

		  /* menampilkan grafik rekap jumlah buku per kategori */

		(function () {
		  'use strict'

		  feather.replace()

		  // Graphs
		  var ctx = document.getElementById('myChart')
		  // eslint-disable-next-line no-unused-vars
		  var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		      labels: [

		      <?php
		      	$numItems = count($kategori);
		      	
				$i = 0;
				$until = ($pageCat + 1);
				$limit = ($pageCat - 5);
				$counta = 0;
				foreach($kategori as $kat) {
  					if($counta < $until && $counta >= $limit){
  						echo '"'.$kat['kategori'].'"';
  						if(++$i === $numItems || $counta == ($until-1)) {
    					
  						}else{
  							echo ",";
  						}
  					}
  					$counta++;
				} 
				?>
		      ],
		      datasets: [{
		        data: [
		        	<?php
		      			$numItems = count($countCat);
						$i = 0;
						$until = ($pageCat + 1) ;
						$limit = ($pageCat - 5);
						$counta = 0;
						foreach($countCat as $cat) {
							if($counta < $until && $counta >= $limit){
  								echo '"'.$cat['jum'].'"';
  								if(++$i === $numItems || $counta == ($until-1)) {
    					
  								}else{
  									echo ",";
  								}
  						}
  						$counta++;
							
						} 
					?>	
		        ],
		        lineTension: 0,
		        backgroundColor: 'transparent',
		        borderColor: '#007bff',
		        borderWidth: 4,
		        pointBackgroundColor: '#007bff'
		      }]
		    },
		    options: {
		      scales: {
		        yAxes: [{
		          ticks: {
		            beginAtZero: false
		          }
		        }]
		      },
		      legend: {
		        display: false
		      }
		    }
		  })
		}())
		</script>

</body></html>