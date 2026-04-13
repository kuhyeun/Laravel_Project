function randomData() {
    return Math.floor(Math.random() * 201) - 100;
}

function getRandomColor() {
    const r = Math.floor((Math.random() * 127) + 127);
    const g = Math.floor((Math.random() * 127) + 127);
    const b = Math.floor((Math.random() * 127) + 127);

    const color = `#${(1 << 24 | r << 16 | g << 8 | b).toString(16).slice(1).toUpperCase()}`;

    return color;
}

export function useChartDebug(chartData) {
    const randomize = () => {
        chartData.value = {
            ...chartData.value,
            datasets: chartData.value.datasets.map(dataset => ({
                ...dataset,
                data: dataset.data.map(() => randomData()),
            })),
        };
    };

    const colorRandomize = () => {
        chartData.value = {
            ...chartData.value,
            datasets: chartData.value.datasets.map(dataset => ({
                ...dataset,
                backgroundColor: getRandomColor(),
                borderColor: getRandomColor()
            })),
        };
    };

    const addDataset = () => {
        const labelCount = chartData.value.labels.length;
        chartData.value = {
            ...chartData.value,
            datasets: [
                ...chartData.value.datasets,
                {
                    label: `L${chartData.value.datasets.length + 1}`,
                    backgroundColor: getRandomColor(),
                    data: Array.from({ length: labelCount }, () => randomData()),
                },
            ],
        };
    };

    const addData = () => {
        chartData.value = {
            labels: [...chartData.value.labels, `L${chartData.value.labels.length + 1}`],
            datasets: chartData.value.datasets.map(dataset => ({
                ...dataset,
                data: [...dataset.data, randomData()],
            })),
        };
    };

    const removeDataset = () => {
        chartData.value = {
            ...chartData.value,
            datasets: chartData.value.datasets.slice(0, -1),
        };
    };

    const removeData = () => {
        chartData.value = {
            labels: chartData.value.labels.slice(0, -1),
            datasets: chartData.value.datasets.map(dataset => ({
                ...dataset,
                data: dataset.data.slice(0, -1),
            })),
        };
    };

    return { randomize, colorRandomize, addDataset, addData, removeDataset, removeData };
}
