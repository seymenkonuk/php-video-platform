<?php
// ============================================================================
// File:    FileValidationHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace App\Support\Helpers;


use Seymenkonuk\Framework\UploadedFile;

use Seymenkonuk\Validator\Validator\Type\CustomValidator;
use Seymenkonuk\Validator\Validator\ValidationResult;
use Seymenkonuk\Validator\Validator\Validator;


class FileValidationHelper
{
    // --------------------------------------------------------------------------
    // PROPERTIES
    // --------------------------------------------------------------------------

    private int $min = 0;
    private int $max = 1024 * 1024 * 1024;
    /** @var array<string>|null $allowedMimes */
    private ?array $allowedMimes = null;
    /** @var array<string>|null $allowedExtensions */
    private ?array $allowedExtensions = null;

    // --------------------------------------------------------------------------
    // CONSTRUCTOR
    // --------------------------------------------------------------------------

    private function __construct(
        private Validator $validator,
    ) {}

    // --------------------------------------------------------------------------
    // FACTORY
    // --------------------------------------------------------------------------

    public static function config(Validator $validator): self
    {
        return new self($validator);
    }

    // --------------------------------------------------------------------------
    // METHODS
    // --------------------------------------------------------------------------

    /** @param array<string> $allowedMimes */
    public function mimes(array $allowedMimes): self
    {
        $this->allowedMimes = $allowedMimes;
        return $this;
    }

    /** @param array<string> $allowedExtensions */
    public function extension(array $allowedExtensions): self
    {
        $this->allowedExtensions = $allowedExtensions;
        return $this;
    }

    public function min(int $min): self
    {
        $this->min = $min;
        return $this;
    }

    public function max(int $max): self
    {
        $this->max = $max;
        return $this;
    }

    public function make(): CustomValidator
    {
        $allowedMimes = $this->allowedMimes ?? [];
        $allowedExtensions = $this->allowedExtensions ?? [];

        return $this->validator->field()->custom(function (mixed $data) use ($allowedMimes, $allowedExtensions) {

            // UploadFile Türünde Olmalı
            if (!($data instanceof UploadedFile)) {
                return ValidationResult::failure("Bu alan dosya olmalıdır1!");
            }

            // 
            if (!$data->isValid()) {
                return ValidationResult::failure("Dosya yüklenirken bir hata oluştu!");
            }

            // Abc
            $extension = $data->getExtension();
            $mime = $data->getMimeType();
            $size = $data->getSize();

            // İzin Verilen Değerlerden Birisi Olmalı
            if (!in_array($extension, $allowedExtensions, true)) {
                return ValidationResult::failure("Geçersiz dosya uzantısı!");
            }

            // İzin Verilen Değerlerden Birisi Olmalı
            if (!in_array($mime, $allowedMimes, true)) {
                return ValidationResult::failure("Geçersiz mime türü!");
            }

            // İzin Verilen Değerlerden Birisi Olmalı
            if ($size < $this->min) {
                return ValidationResult::failure("Dosya boyutu çok küçük!");
            }

            // İzin Verilen Değerlerden Birisi Olmalı
            if ($size > $this->max) {
                return ValidationResult::failure("Dosya boyutu çok büyük!");
            }

            return ValidationResult::success($data);
        });
    }
}
