


<!DOCTYPE html>
<html lang="en" ng-app="gameApp">

<head>
    <meta charset="UTF-8">
    <title>Game Showcase - Fragstore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/icons/array.png">
    <link rel="stylesheet" href="content.css">
</head>

<body ng-controller="GameController">

    <div ng-if="error" style="text-align: center; color: #ff4444; padding: 2rem;">
        {{ error }}
    </div>

    <div ng-if="game">
        <!-- Hero Section -->
        <div class="hero-section">
            <img ng-src="{{ game.background_image || placeholder }}"
                alt="{{ game.name }}"
                class="hero-image">
        </div>

        <!-- Product Header -->
        <div class="container">
            <div class="product-header">
                <h1 class="game-title title-gradient">
                    {{ game.name }}
                </h1>

                <div class="platform-tags">
                    <div ng-repeat="t in tags track by t.id">
                        <span class="platform-tag">{{t.name}}</span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Released</div>
                        <div class="info-value">{{ game.released || 'TBA' }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Rating</div>
                        <div class="info-value">{{ game.rating || 'N/A' }}/5</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Metacritic</div>
                        <div class="info-value">{{ game.metacritic || 'N/A' }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">Playtime</div>
                        <div class="info-value">{{ game.playtime || '?' }} hrs</div>
                    </div>
                </div>

                <!-- Description -->
                <div class="description-section">
                    <h3>About This Game</h3>
                    <p>{{ clean(game.description_raw) }}</p>
                </div>
            </div>

            <!-- Screenshots -->
            <h2 class="section-title">Screenshots</h2>
            <div class="screenshots-grid">
                <div ng-repeat="s in screenshots" class="screenshot-item">
                    <img ng-src="{{ s.image }}" alt="Screenshot">
                </div>
            </div>

            <h2 class="section-title">DLC & Editions</h2>
            <div ng-if="additions.length > 0">
                <div id="additions">
                    <div ng-repeat="a in additions" class="addition-card">
                        <img ng-src="{{ a.background_image || placeholder }}" alt="{{ a.name }}">
                        <div class="addition-info">
                            <div class="addition-name">{{ a.name || 'Untitled Edition' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div ng-if="additions.length === 0" class="empty-message">
                No DLC or additional editions available for this game.
            </div>


            <h2 class="section-title">Major Achievements</h2>
            <div ng-if="achievements.length > 0">
                <div class="achievements-grid">
                    <div ng-repeat="a in achievements" class="achievement-card">
                        <img ng-src="{{ a.image }}" alt="{{ a.name }}">
                        <div class="achievement-name">{{ a.name || 'Secret Achievement' }}</div>
                        <div class="achievement-desc">{{ a.description || 'Unlock to reveal details' }}</div>
                    </div>
                </div>
            </div>
            <div ng-if="achievements.length === 0" class="empty-message">
                No achievements available for this game.
            </div>

            <div class="spacing-bottom"></div>
        </div>
    </div>

    <script src="content.js"></script>
</body>

</html>