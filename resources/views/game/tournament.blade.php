<!DOCTYPE html>
<html lang="en">
<x-header/>
<body>
  <div class="container">
    <x-logo/>
    <h1 class="text-center mb-4" style="color: #2c3e50;">Tournament: 12 Feb 2025</h1>

    <!-- Winner Section -->
<div class="group text-center py-5" style="background-color: #2c3e50; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
  <h2 class="text-white mb-4"><i class="fas fa-trophy"></i> Tournament Winner</h2>
  <div class="winner-card d-inline-block p-4" style="background-color: #3498db; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <h1 class="text-white mb-0" style="font-size: 3rem; font-weight: bold;">
      <i class="fas fa-crown"></i> Player 1
    </h1>
  </div>
</div>

    <!-- Group A -->
    <div class="group">
      <h3><i class="fas fa-users"></i> Group A</h3>
      <table class="fixture-table table">
        <thead>
          <tr>
            <th>#</th>
            <th>Player 1</th>
            <th>Player 2</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Player 1</td>
            <td>Player 2</td>
            <td>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal1">
                <i class="fas fa-plus"></i> 
              </button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Player 3</td>
            <td>Player 4</td>
            <td>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal2">
                <i class="fas fa-plus"></i> 
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Group B -->
    <div class="group">
      <h3><i class="fas fa-users"></i> Group B</h3>
      <table class="fixture-table table">
        <thead>
          <tr>
            <th>#</th>
            <th>P1</th>
            <th>P2</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Player 5</td>
            <td>Player 6</td>
            <td>0 - 0</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Player 7</td>
            <td>Player 8</td>
            <td>0 - 0</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Semi-Final and Final -->
    <div class="group">
      <h3><i class="fas fa-trophy"></i> Semi-Final</h3>
      <table class="fixture-table table">
        <thead>
          <tr>
            <th>Player 1</th>
            <th>Player 2</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            
            <td>Top 1 from Group A</td>
            <td>Top 2 from Group B</td>
            <td>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal5">
                <i class="fas fa-plus"></i> 
              </button>
            </td>
          </tr>
          <tr>
            
            <td>Top 2 from Group A</td>
            <td>Top 1 from Group B</td>
            <td>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal6">
                <i class="fas fa-plus"></i> 
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="group">
      <h3><i class="fas fa-trophy"></i> Final</h3>
      <table class="fixture-table table">
        <thead>
          <tr>
            <th>Player 1</th>
            <th>Player 2</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Winner of Semi-Final 1</td>
            <td>Winner of Semi-Final 2</td>
            <td>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal7">
                <i class="fas fa-plus"></i> 
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Scoreboard -->
    <div class="group">
      <h3><i class="fas fa-chart-bar"></i> Scoreboard</h3>
      <table class="scoreboard-table table">
        <thead>
          <tr>
            <th>#</th>
            <th>Player</th>
            <th>Wins</th>
            <th>Losses</th>
            <th>Points</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Player 1</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Player 2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Score Modals (Example for one modal, repeat for others) -->
  <div class="modal fade" id="scoreModal1" tabindex="-1" aria-labelledby="scoreModal1Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scoreModal1Label"> for Match 1</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="scorePlayer1" class="form-label">Player 1 Score</label>
              <input type="number" class="form-control" id="scorePlayer1" required>
            </div>
            <div class="mb-3">
              <label for="scorePlayer2" class="form-label">Player 2 Score</label>
              <input type="number" class="form-control" id="scorePlayer2" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Score</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>