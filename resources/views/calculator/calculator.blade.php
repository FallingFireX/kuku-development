@extends('home.layout')

@section('title') Namethatshowsupinbrowsertab @endsection



{!! breadcrumbs(['namethatshowsupattopofpage' => 'linkthatgoesthere']) !!}
@section('content')
    
    <style>
        .calculator {
        width: 100%;
        height: 620px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        
        }
        #output {
        width: 100%;
        height: 450px;
        margin-bottom: 20px;
        padding: 10px;
        box-sizing: border-box;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        resize: none;
        }
        
        #word-count-input, #multiplier-input {
        width: 100px;
        height: 30px;
        margin: 10px 0;
        font-size: 16px;
        text-align: center;
        display: block;
        }
    </style>
    



<body>
  <div class="calculator">
    <div class=row>
        <div class = "col-md-4">
            <textarea id="output" readonly></textarea>
        </div>
    <br>
    <div class = "col-md-8">
        <div class = "row">
            <div class = "col-md-4">
                <h4 style="text-align: center">Headshot</h4>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Base', 1)">Base</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Colored', 2)">Colored</button>
                <button class="btn" style="width: 80px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Shaded', 1)">Shaded</button>
                <button class="btn" style="width: 110px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Background', 1)">Background</button>
            </div>

            <div class = "col-md-4">
                <h4 style="text-align: center">Full Body</h4>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Base', 2)">Base</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Colored', 3)">Colored</button>
                <button class="btn" style="width: 80px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Shaded', 2)">Shaded</button>
                <button class="btn" style="width: 110px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Background', 2)">Background</button>
            </div>

            <div class = "col-md-4">
                <h4 style="text-align: center">Liturature</h4>
                <input type="text" id="word-count-input" style="width: 100%" placeholder="Enter word count">
                <button class="btn" style="width: 100%; height: 40px; margin: 5px; font-size: 16px; margin-left: 0%" onclick="calculateWordCount()">Get Wordcount FP</button>
            </div>

            <div class = "col-md-6">
                <br>
                    <h5>General Bonuses</h5>
                    <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Personal', 2)">Personal</button>
                    <button class="btn" style="width: 110px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Other_kukuri', 2)">Other kukuri</button>
                    <button class="btn" style="width: 80px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Handler', 2)">Handler</button>
                    <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Collab', 1)">Collab</button>
                    <button class="btn" style="width: 110px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Other_arpg', 1)">Other arpg</button>
                    <button class="btn" style="width: 80px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Comic', 1)">Comic</button>
                    <button class="btn" style="width: 147px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Elemental Armor', 1)">Elemental Armor</button>
                    <button class="btn" style="width: 147px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Armor/Tack', 1)">Armor/Tack</button>
                <br>
            </div>

            <div class = "col-md-6">
                <br>
                <h5>Activity Bonuses</h5>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Activities', 2)">Activities</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Coliseum', 2)">Coliseum</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Quest', 2)">Quest</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Letters', 2)">Letters</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('FoD', 2)">FoD</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('CoL', 3)">CoL</button>
                <br>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Familiars', 1)">Familiars</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Tribe', 1)">Tribe</button>
                <button class="btn" style="width: 95px; height: 40px; margin: 5px; font-size: 16px" onclick="addValue('Mascot', 2)">Mascot</button>
                
                <br>
            </div>

            <div class = "col-md-6">
            
                <br><br>
            </div>
        </div>
        <div class="row">
            <div class = "col-md-3">
                <i>To get the totals for multiple headshots or fullbodies, enter a number below and click calculate!</i>
                <input type="text" id="multiplier-input" style="width: 100%" placeholder="Enter multiplier">
                <button class="btn" style="width: 100%" onclick="multiply()">Multiply</button>  
            </div>

            <div class = "col-md-3">
                <i>Switch between fullbody and headshot calculations here. Be warned, this will create new instances of each every time you press it (this is good for comics)!</i>
                <button class="btn" style="width: 100%; margin-top: 5%" onclick="finalizeSet()">Switch type</button>
            </div>

            <div class = "col-md-3">
                <h5 style="text-align: center">Clear FP</h5>
                <button class="btn" style="width: 100%" onclick="clearAll()">Clear</button>
            </div>
    </div>
    <br>
    <i style = "text-align: center">Switching the type will remove the multiplier; make sure that is the last set you do, or do those seperately</i>
    <br>
  </div>
  @endsection
  
@section('scripts')

  <script>
    let sets = []; // Array to track multiple sets
    let currentSet = {
      Word_Count: 0,
      Word_Count_FP: 0,
      Base: 0,
      Colored: 0,
      Shaded: 0,
      Background: 0,
      Personal: 0,
      Collab: 0,
      Other_arpg: 0,
      Other_kukuri: 0,
      Activities: 0,
      Handler: 0,
      Comic: 0,
      Elemental_Armor: 0,
      Armor_or_Tack: 0,
      Quest: 0,
      CoL: 0,
      FoD: 0,
      Letters: 0,
      Familiars: 0,
      Tribe: 0,
      Mascot: 0,
      total: 0
    };

    const output = document.getElementById('output');

    function addValue(label, value) {
      currentSet[label] += value;
      currentSet.total += value; // Update the total for the current set
      renderOutput();
    }

    function renderOutput(multipliedResult = null, multiplier = null) {
      // Generate output for all sets, including the current one
      let result = '';
      sets.forEach((set, index) => {
        result += ``;
        result += formatSet(set);
        result += `\n\n`;
      });

      // Display the current set separately
      result += ``;
      result += formatSet(currentSet);

      // Show multiplied result if a multiplier is applied
      if (multipliedResult !== null && multiplier !== null) {
        result += `\n${currentSet.total} x ${multiplier} = ${multipliedResult}`;
      }

      output.value = result;
    }

    function formatSet(set) {
      let result = '';
      for (let key in set) {
        if (key !== 'total' && set[key] !== 0) {
          result += `${key.replace("_"," ")}: +${set[key]}\n`;
        }
      }
      result += `\nTotal: ${set.total}`;
      return result;
    }

    function multiply() {
      const multiplierInput = document.getElementById('multiplier-input').value;
      const multiplier = parseFloat(multiplierInput);
      if (isNaN(multiplier)) {
        alert('Please enter a valid number.');
        return;
      }
      const multipliedResult = Math.round(currentSet.total * multiplier);
      
      currentSet.multiplier += renderOutput(multipliedResult, multiplier);
    }

    function calculateWordCount() {
      const wordCountInput = document.getElementById('word-count-input').value;
      const wordCount = parseFloat(wordCountInput);
      currentSet.Word_Count = document.getElementById('word-count-input').value;

      if (isNaN(wordCount) || wordCount <= 0) {
        alert('Please enter a valid word count.');
        return;
      }

      const result = wordCount / 150;
      const roundedResult = result % 1 === 0 ? Math.floor(result) : Math.ceil(result);
      
      currentSet.Word_Count_FP = roundedResult;
      currentSet.total += roundedResult;

      renderOutput();
    }

    function finalizeSet() {
      if (currentSet.total === 0) {
        alert('The current set is empty. Please add values first.');
        return;
      }
      sets.push({ ...currentSet }); // Save the current set
      // Reset the current set
      currentSet = {
        Word_Count: 0,
        Word_Count_FP: 0,
        Base: 0,
        Colored: 0,
        Shaded: 0,
        Background: 0,
        Personal: 0,
        Collab: 0,
        Other_arpg: 0,
        Other_kukuri: 0,
        Activities: 0,
        Handler: 0,
        Comic: 0,
        Elemental_Armor: 0,
        Armor_or_Tack: 0,
        Quest: 0,
        CoL: 0,
        FoD: 0,
        Letters: 0,
        Familiars: 0,
        Tribe: 0,
        Mascot: 0,
        total: 0
      };
      renderOutput();
    }

    function clearAll() {
      sets = [];
      currentSet = {
        Word_Count: 0,
        Word_Count_FP: 0,
        Base: 0,
        Colored: 0,
        Shaded: 0,
        Background: 0,
        Personal: 0,
        Collab: 0,
        Other_arpg: 0,
        Other_kukuri: 0,
        Activities: 0,
        Handler: 0,
        Comic: 0,
        Elemental_Armor: 0,
        Armor_or_Tack: 0,
        Quest: 0,
        CoL: 0,
        FoD: 0,
        Letters: 0,
        Familiars: 0,
        Tribe: 0,
        Mascot: 0,
        total: 0
      };
      output.value = '';
    }
  </script>

@endsection
