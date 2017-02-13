## Benchmark
>- **Namespace**: KrameWork\Timing\Benchmarking\Benchmark
>- **File**: KrameWork7/Timing/Benchmarking

### Basic Usage
The `Benchmark` class provided by KrameWork7 is an easy-to-use class for creating simple benchmarks of your code. The quickest (and most common) method of using this class is to create an anonymous class that extends `Benchmark`.
```php
$benchmark = new class extends Benchmark {
	public function runCycle() {
		// Your code to benchmark here!
	}
};
```
Your anonymous class must implement the `runCycle()` function, which is called by default **2000** times once the benchmark test is run, which we'll do now!
```php
$result = $benchmark->runTest();
```
With the call to `runTest()`, our benchmark will run **2000** times, and the results will be stored in `$result`, a `BenchmarkResult`, detailed below.
Method | Type | Description
--- | --- |---
**getName()** | string | Name of the benchmark. Produces sensible default if omitted in `Benchmark` constructor.
**getAverage()** | float | Average time for all cycles in the benchmark.
**getShortest()** | float | Time of the shortest cycle.
**getLongest()** | float | Time of the longest cycle.
**getElapsed()** | float | Total elapsed time of the entire benchmark.
**getCount()** | int | Cycle count (as provided in the `Benchmark` constructor).

### Controlling Cycle Count
As stated above, a benchmark will run **2000** times by default; it's likely that you'll want to customize this value, which can be done by passing a new value into the constructor. The following example will execute **1,000,000** times.
```php
$benchmark = new class (1000000) extends Benchmark {
	//...
}
```
### Naming Benchmarks
All good benchmarks deserve a name, they're real people too. The second parameter to the constructor can be used to provide a name for the benchmark, otherwise a boring generic one will be assigned.
```php
$benchmark = new class(100, 'Carl') extends Benchmark {
    //...
}
```
### Pre/Post Benchmark Operations
It's common that your benchmark will most likely have some data or operations to perform before the test is run, and similar deconstruction operations to perform once the test is done. This can be achieved by overwriting the `onStart()` and `onEnd()` functions within the class.
```php
$benchmark = new class extends Benchmark {
	public function onStart() {
		// This will be called just before the benchmark starts.
	}
	
	public function runCycle() {
		// Your code to benchmark here!
	}

	public function onEnd() {
		// This will be called once the benchmark is finished, just before
		// the result is returned.
	}
};
```
Neither `onStart()` or `onEnd()` are included in the benchmark timings, only the execution of `runCycle()`.