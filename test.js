
  //using countWords function, make a function that returns a specific number of words in a stringArray
    function countWords(string, number=0){
        var stringArray = string.split(" ");
        var count = 0;
        for(var i = 0; i < stringArray.length; i++){
            count++;
        }
        if(number == 0){
            return count;
        }
        else if(number > count){
            return string;
        }
        else{
            return stringArray.slice(0, number);
        }
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
