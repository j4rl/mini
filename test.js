//make function that counts words in a string
function countWords(string){
    var stringArray = string.split(" ");
    var count = 0;
    for(var i = 0; i < stringArray.length; i++){
      count++;
    }
    return count;
  }

  //Starting in the top left corner of a 2×2 grid, and only being able to move to the right and down, there are exactly 6 routes to the bottom right corner. How many such routes are there through a 20×20 grid?
    function countRoutes(gridSize){
      var gridSize = gridSize;
      var count = 0;
      for(var i = 0; i < gridSize; i++){
        for(var j = 0; j < gridSize; j++){
          count++;
        }
      }
      return count;
    }
