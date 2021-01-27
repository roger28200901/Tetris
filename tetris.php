<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>俄羅斯方塊</title>
</head>

<body>
<div style="border:1px solid black; width: 700px; height:680px; left:50%; top:5%; position:absolute; margin-left:-350px; ">
<canvas id="tetris" width="300" height="660" style="border:3px solid gray; margin:5px;">
</canvas>
<canvas id="next" width="120" height="120" style="border:1px solid black; position:absolute; left:400px;">
</canvas> 
</div>

<script>
	var canvas = document.getElementById('tetris');
	var ctx = canvas.getContext('2d');
	var ctxx = document.getElementById('next').getContext('2d');
	var matrix = [];
	var player = {
			pos:{x:5,y:0},
			matrix:matrix,
			nextMatrix:'',
		};

	function draw(){		
		ctx.fillStyle = 'black';
		ctx.fillRect(0,0,canvas.width,canvas.height);		
		}
		
	
	function drawMatrix(matrix,offset){
			matrix.forEach(function(row,y){
					row.forEach(function(value,x){
							if(matrix = arena){
								ctx.beginPath();
								ctx.strokeStyle = 'white';
								ctx.rect(x*30,y*30,30,30);
								ctx.lineWidth = 1;
								ctx.stroke();
								}
							if(value != 0){
									ctx.fillStyle = randColor(value);
									ctx.fillRect((x+offset.x)*30,(y+offset.y)*30,30,30);
								}	
						});
				});	
		}
	function randColor(value)
	{
		switch(value){
			case 1:
			return 'red';
			break;
			case 2:
			return 'green';
			break;
			case 3:
			return 'blue';
			break;
			case 4:
			return 'pink';
			break;
			case 5:
			return 'yellow';
			break;
			case 6:
			return 'orange';
			break;
			case 7:
			return 'gray';
			break;	
			}	
	
		}		
	function drawNextMatrix(matrix){
			ctxx.fillStyle = 'black';
			ctxx.fillRect(0,0,120,120);
			matrix.forEach(function(row,y){
					row.forEach(function(value,x){
								ctxx.beginPath();
								ctxx.strokeStyle = 'white';
								ctxx.rect(x*30,y*30,30,30);
								ctxx.lineWidth = 1;
								ctxx.stroke();
								
								if(value != 0){
									
									ctxx.fillStyle = randColor(value);
									ctxx.fillRect((x)*30,(y)*30,30,30);
								}	
						});
				});	
		}
	function createArena(w,h){
			var matrix = [];
			while(h--){
					matrix.push(new Array(w).fill(0));
				}
				return matrix;
		}
	var arena = createArena(10,22);	
	function collide(arena,player){
			for(var y = 0; y < player.matrix.length ; y++){
					for(var x = 0; x <player.matrix[y].length;x++){
							if(player.matrix[y][x] !== 0 && (arena[y+player.pos.y] && arena[y+player.pos.y][x+player.pos.x]) !== 0){
										return true;
								}	
						}
				}	
				
				return false;
		}
	function merge(arena,player){
			player.matrix.forEach(function(row,y){
					row.forEach(function(value,x){
							if(value !== 0)
							arena[y+player.pos.y][x+player.pos.x] = value;
						});
				});
		}
	
	//update
	
	
	var dropInterval  = 0;
	var dropCounter = 0	
	var lastTime = 0;
	var deltaTime = 0;
	
	function update(time = 0)
	{
		//level
		switch(<?=$_POST['level']?>){
		case 0:
			dropInterval = 1000;
		break;
		case 1:
			dropInterval = 250;
		break;
		}
		
		
		deltaTime = time - lastTime;
		lastTime = time;
		dropCounter += deltaTime;
		if(dropCounter > dropInterval){ 
			dropCounter = 0;
			drop();	
		}
		
		draw();
		drawNextMatrix(player.nextMatrix);
		drawMatrix(player.matrix,player.pos);
		drawMatrix(arena,{x:0,y:0});
		requestAnimationFrame(update);
		}
		
	//keyDown Event
		
	function playerMove(dir){
		player.pos.x += dir;
		if(collide(arena,player)){
			player.pos.x -= dir;
			}
	}
	
	function rotate(matrix,dir){
			console.log(matrix)
			playerRotate(matrix,dir);
			if(collide(arena,player))
			{
			playerRotate(matrix,-dir);
				}
		}
	function playerRotate(matrix,dir){
			for(var y = 0 ;y < matrix.length;y++){
					for(var x = 0 ; x< y ;x++){
							[matrix[y][x],matrix[x][y]] = [matrix[x][y],matrix[y][x]];
						}
				}
			if(dir > 0){
				matrix.forEach(function(row,y){
					row.reverse();
					});
				}else{
				matrix.reverse();					
				}
		}
	function cleanLine(arena){
		
		outer :for(var y = arena.length - 1 ; y > 0;y--){
				  console.log(x)
				  for(var x = 0; x < arena[y].length;x++)
				  {	
				  		
						if(arena[y][x] == 0)
						{
							
							continue outer;
						}			
				}
				var row = arena.splice(y,1)[0].fill(0);	
				console.log(row)
				arena.unshift(row);
				y++;
				}	
					
		}
	function drop(){
		player.pos.y++;	
			if(collide(arena,player)){
				player.pos.y--;
				merge(arena,player);	
				cleanLine(arena);
				player.matrix = player.nextMatrix;
				player.nextMatrix = randMatrix();
				player.pos.y = 0;
				player.pos.x = 5;
			}
	}
	document.addEventListener('keydown',function(event){
			var keyCode = event.keyCode;
			if(keyCode == 37){	 //left
			playerMove(-1);				
			}else if(keyCode == 38){
			rotate(player.matrix,1);	
			}else if(keyCode == 39){
			playerMove(1);	
			}else if(keyCode == 40){
			drop();	
			}
		})
	function randMatrix(){
		var str = 'IJLOTSZ';
		var rnd = parseInt(Math.random()*7);
		str = str.charAt(rnd);			
		switch(str){
				case 'I':
					matrix = [
							[1,0,0,0],
							[1,0,0,0],
							[1,0,0,0],
							[1,0,0,0]
							];
				break;
				case 'J':
					matrix = [
							[0,2,0],
							[0,2,0],
							[2,2,0]
							];
				break;
				case 'L':
					matrix = [
							[0,3,0],
							[0,3,0],
							[0,3,3]	
							];				
				break;
				case 'O':
					matrix = [
							[4,4],
							[4,4]
							];
				break;
				case 'T':
					matrix = [
							[5,5,5],
							[0,5,0],
							[0,0,0]
							];	
				break;
				case 'S':
					matrix = [
							[6,0,0],
							[6,6,0],
							[0,6,0]
							];
				break;
				case 'Z':
					matrix = [
							[0,0,0],
							[7,7,0],
							[0,7,7]
							];
				break;				
			}
			return matrix;	
				
		}	
	player.matrix = randMatrix();
	player.nextMatrix = randMatrix();
	update();
		
</script>
</body>
</html>