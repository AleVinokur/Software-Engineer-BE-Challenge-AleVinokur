<?php
namespace App;

class CircularWordChain
{
    public function build(array $words): array
    {
        $mappedWords = $this->mapFirstAndLastLetter($words);
        return $this->findCircularChain($words, $mappedWords);
    }

    private function findCircularChain(array $words, array $mappedWords): array
    {
        $count = count($words);
        for ($offset = 0; $offset < $count; $offset++) {
            $trialWords = $this->rotateArray($words, $offset);
            $trialMapped = $this->rotateArray($mappedWords, $offset);

            if ($this->arrangeSequentialChain($trialWords, $trialMapped)) {
                return $trialWords;
            }
        }

        return [];
    }

    /**
     * Reordena la lista a partir de un pivot inicial buscando coincidencias secuenciales.
     */
    private function arrangeSequentialChain(array &$words, array &$mappedWords): bool
    {
        $count = count($words);

        if ($count === 0) {
            return false;
        }

        $i = 0;
        $k = 1;

        do {
            if ($k >= $count) {
                return false;
            }

            if ($mappedWords[$i][1] === $mappedWords[$k][0]) {
                if ($k !== $i + 1) {
                    $wordToMove = $words[$k];
                    $lettersToMove = $mappedWords[$k];

                    array_splice($words, $k, 1);
                    array_splice($mappedWords, $k, 1);

                    array_splice($words, $i + 1, 0, [$wordToMove]);
                    array_splice($mappedWords, $i + 1, 0, [$lettersToMove]);
                }

                $i++;
                $k = $i + 1;
                continue;
            }

            $k++;
        } while ($i < $count - 1);

        return $this->formsCircle($mappedWords);
    }

    private function rotateArray(array $items, int $offset): array
    {
        if ($offset === 0) {
            return $items;
        }

        return array_merge(
            array_slice($items, $offset),
            array_slice($items, 0, $offset)
        );
    }

    private function formsCircle(array $mappedWords): bool
    {
        $count = count($mappedWords);

        if ($count === 0) {
            return false;
        }

        if ($count === 1) {
            return $mappedWords[0][0] === $mappedWords[0][1];
        }

        for ($i = 0; $i < $count - 1; $i++) {
            if ($mappedWords[$i][1] !== $mappedWords[$i + 1][0]) {
                return false;
            }
        }

        return $mappedWords[$count - 1][1] === $mappedWords[0][0];
    }
    
    private function mapFirstAndLastLetter(array $words): array
    {
        $mapped = [];
        foreach ($words as $word) {
            $firstLetter = mb_substr($word, 0, 1, 'UTF-8');
            $lastLetter = mb_substr($word, -1, 1, 'UTF-8');
            $mapped[] = [$firstLetter, $lastLetter];
        }

        return $mapped;
    }
}
