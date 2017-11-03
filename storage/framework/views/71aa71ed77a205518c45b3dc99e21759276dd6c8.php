<div class="content flex column">

	<div class="settings flex wrap">
		<!-- <div class="item flex">
			<p><b> 2. JSON data: </b></p>
			<button onclick="TEST_jsonToData()">JSON to Data</button>
		</div> -->
		<div class="item flex">
			<!-- <p><b> 3. SMA, EMA settings: </b></p> -->
			<input type="checkbox" id="sma0Show" onclick="checkForm()">
			<label for="sma0Show">SMA0</label>
			<input type="text" id="sma0_value" value="10" style="width: 40px">
			<input type="checkbox" id="sma1Show" onclick="checkForm()">
			<label for="sma1Show">SMA1</label>
			<input type="text" id="sma1_value" value="20" style="width: 40px">
			<input type="checkbox" id="ema2Show" onclick="checkForm()">
			<label for="ema2Show">SMA2</label>
			<input type="text" id="ema2_value" value="50" style="width: 40px">
		</div>
		<div class="item flex">
			<!-- <p><b> 4. MAC, RSI settings: </b></p> -->
			<label for="macdShow">Show MACD</label>
			<input type="checkbox" id="macdShow" onclick="checkForm()">
			<label for="rsiShow">Show RSI </label>
			<input type="checkbox" id="rsiShow" onclick="checkForm()">
		</div>
		<div class="item flex">
			<!-- <p><b> 5. View settings: </b></p> -->
			<select onchange="chartType(parseInt(this.value))">Point type
				<option value="0">OHLC</option>
				<option selected value="1">CandleStick</option>
				<option value="2">Close</option>
			</select>
			<button onclick="addTrendline()">Add trendline</button>
			<button class="black_button" onclick="setBackground()">Change background</button>
			<!-- <button onclick="destroyChart()">clear</button> -->
			<!-- <button onclick="sendRequest()">Request</button> -->
		</div>
	</div>
    <div id="chart_field"></div>
</div>
