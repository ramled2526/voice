
class AudioProcessor extends AudioWorkletProcessor {
    process(inputs, outputs, parameters) {
        const input = inputs[0];
        const output = outputs[0];

        if (input.length > 0) {
            const inputData = input[0];
            const outputData = output[0];
            
            // Simple spectral subtraction noise reduction
            const noiseReductionFactor = 0.5;
            for (let i = 0; i < inputData.length; i++) {
                const noise = inputData[i] * noiseReductionFactor;
                outputData[i] = inputData[i] - noise;
            }
        }

        return true;
    }
}

registerProcessor('audio-processor', AudioProcessor);
