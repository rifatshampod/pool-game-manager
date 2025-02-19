<!DOCTYPE html>
<html lang="en">
<x-header/>
<body class="bg-light">
  <div class="container py-4">
    <x-logo/>
    <div class="form-container">
      <h2 class="text-center mb-4">Create Game</h2>
      <form id="createGameForm" action="{{ route('game.store') }}" method="POST">
        @csrf
        <!-- Date Input Field -->
            <div class="mb-3">
                <label for="gameDate" class="form-label">Game Date</label>
                <input type="date" class="form-control" id="gameDate" name="gameDate" required>
            </div>
            <div class="mb-3">
                <label for="boardNumber" class="form-label">Number of Boards</label>
                <input type="number" class="form-control" id="boardNumber" name="boardNumber" required value=2>
            </div>

            <!-- Player Dropdown Fields -->
            <div id="playerFields">
              <label for="gameDate" class="form-label">Players</label>
                <div class="player-input-group">
                    <select class="form-select" name="players[]" required>
                        <option value="">Select Player</option>
                        @foreach ($playerList as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-plus-circle add-player-btn" onclick="addPlayerField()"></i>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Create Game</button>
            </div>
        </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // Function to add a new player dropdown field
  function addPlayerField() {
      const playerFields = document.getElementById('playerFields');

      // Create a new player input group
      const newPlayerGroup = document.createElement('div');
      newPlayerGroup.className = 'player-input-group';

      // Create the dropdown select element
      const select = document.createElement('select');
      select.className = 'form-select';
      select.name = 'players[]'; // Ensure it's an array
      select.required = true;

      // Dynamically generate player options using Blade templating
      const playerOptions = `
          <option value="">Select Player</option>
          @foreach ($playerList as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
      `;
      select.innerHTML = playerOptions;

      // Create the plus icon
      const plusIcon = document.createElement('i');
      plusIcon.className = 'fas fa-plus-circle add-player-btn';
      plusIcon.onclick = addPlayerField;

      // Create the minus icon
      const minusIcon = document.createElement('i');
      minusIcon.className = 'fas fa-minus-circle remove-player-btn';
      minusIcon.onclick = function () {
          playerFields.removeChild(newPlayerGroup); // Remove the player field
      };

      // Append the select, plus icon, and minus icon to the new player group
      newPlayerGroup.appendChild(select);
      newPlayerGroup.appendChild(plusIcon);
      newPlayerGroup.appendChild(minusIcon);

      // Append the new player group to the playerFields container
      playerFields.appendChild(newPlayerGroup);
  }

  // Handle form submission
  
</script>
</body>
</html>