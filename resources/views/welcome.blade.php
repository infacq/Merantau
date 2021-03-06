<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<title>Merantau</title>
		<link href="/css/vendor.css" rel="stylesheet" type="text/css">
	</head>
	<body ng-app="getLostApp" ng-cloak>
		<md-content>
			<md-toolbar>
				<div class="md-toolbar-tools">
				<md-button class="md-icon-button" aria-label="Settings">
					<md-icon md-svg-icon="/img/maps/svg/design/ic_local_airport_24px.svg"></md-icon>
				</md-button>
				<h2><span class="md-title">Get Lost!</span></h2>
				</div>
			</md-toolbar>
			{{-- The content area --}}
			<div layout="row">
			{{-- 20% padding to the left --}}
				<div flex="20"></div>
				{{-- The main action happens here --}}
				<md-card flex ng-controller="MainCtrl as ctrl">
					<md-card-content>
						<!-- The row for the city select autocomplete list -->
						<md-content>
							<md-autocomplete  md-selected-item="ctrl.selectedItem"
								md-search-text="ctrl.searchText"
								md-items="item in ctrl.querySearch(ctrl.searchText)"
								md-item-text="item.display"
								md-min-length="0"
								placeholder="Where are you flying from?">
								<md-item-template>
									<span md-highlight-text="ctrl.searchText" md-highlight-flags="^i">@{{item.display}}</span>
								</md-item-template>
								<md-not-found>
									No matches found for "@{{ctrl.searchText}}".
								</md-not-found>
							</md-autocomplete>
							<md-tooltip>
								Pick the city you want to start from!
							</md-tooltip>
							<p class="md-caption">NYC, CHI and LON work well</p>
						</md-content>
						<!-- The row for the budget and dates -->
						<div layout>
							<md-input-container flex>
								<md-select placeholder="Set your budget" ng-model="info.maxfare">
									<div ng-repeat="p in prices">
										<md-option value="@{{p.value}}">@{{p.show}}</md-option>
									</div>
								</md-select>
							</md-input-container>
							<md-input-container flex>
								<label>Start date</label>
								<input type="date" ng-model="info.departuredate">
							</md-input-container>
							<md-input-container flex>
								<label>End date</label>
								<input type="date" ng-model="info.returndate">
							</md-input-container>
						</div>
						{{-- The submit button --}}
						<div layout>
							<md-button class="md-raised md-primary" ng-click="submit()">Search for destinations!</md-button>
						</div>
						<!-- The results -->
						<md-content ng-show="fareinfo">
							<md-list>
								<md-subheader class="md-no-sticky">Results</md-subheader>
								<md-list-item class="md-3-line" ng-repeat="item in fareinfo | orderBy:'LowestFare'">
									<div class="md-list-item-text">
										<h3>Destination: @{{ item.DestinationLocation }}</h3>
										<h4>Lowest fare: RM @{{ item.LowestFare }}</h4>
										<p>Lowest non-stop fare: RM @{{ item.LowestNonStopFare }}</p>
									</div>
									<md-divider></md-divider>
								</md-list-item>
							</md-list>
						</md-content>
					<md-card-content>
				</md-card>
				<div flex="20"></div>
			</div>
		</md-content>
	<script src="/js/vendor.js"></script>
	<script src="/js/all.js"></script>
	</body>
</html>
