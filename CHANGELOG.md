# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.8] - 2025-09-08

### Added
- **Reportable Exceptions Configuration**: Added `reportable_exceptions` array for whitelist filtering
- **Enhanced Enable/Disable Control**: Added proper `enabled` check in ExceptionEmailer
- **Improved Configuration Documentation**: Updated README with detailed configuration explanations

### Fixed
- **Rate Limiting Implementation**: Fixed rate limiting to use proper hourly counting instead of time-based blocking
- **Configuration Structure**: Aligned ExceptionEmailer rate limiting logic with config file structure
- **Cache Key Prefix**: Now uses configurable cache key prefix from config
- **ExceptionNotification Dependency**: Fixed circular dependency issue in ExceptionNotification constructor

### Changed
- **Rate Limiting Logic**: Changed from minute-based to hour-based rate limiting
- **Cache Implementation**: Updated to count emails per hour instead of boolean flags
- **Configuration Validation**: All config keys now properly validated and documented

### Improved
- **README Documentation**: Added comprehensive configuration explanations
- **Exception Filtering**: Better support for both blacklist (skip) and whitelist (reportable) patterns
- **Code Structure**: Enhanced code organization and consistency

## [1.0.7] - 2025-08-20

### Changed
- Enhanced package structure and organization
- Improved local development setup

## [1.0.6] - 2025-08-19

### Changed
- Version bump to 1.0.6

## [1.0.5] - 2025-08-19

### Changed
- Version bump to 1.0.5

## [1.0.1] - 2025-08-19

### Changed
- Enhanced README with Packagist badges (version, downloads, license, PHP version)
- Simplified installation instructions now that package is available on Packagist
- Added Quick Start section for easier setup process
- Updated author contact information
- Improved documentation structure and formatting for public release

### Fixed
- Updated installation method to use `composer require` instead of local path

## [1.0.0] - 2025-08-19

### Added
- Initial release of Laravel Catch Exception package
- Automatic exception catching and email notifications
- Support for multiple email recipients
- Responsive email templates that work on all devices and email clients
- Rate limiting to prevent email spam
- Configurable exception filtering
- Rich exception information including request data, stack trace, and user info
- Queue support for async email sending
- Built-in testing commands and web routes
- Enhanced stack trace with color coding and source type indicators
- Support for Laravel 8.x, 9.x, 10.x, and 11.x
- PHP 8.0+ compatibility

### Features
- 🚨 Automatic exception catching with Laravel integration
- 📧 Multiple recipient email notifications
- 📱 Fully responsive email design
- ⚡ Rate limiting with configurable thresholds  
- 🔧 Exception type filtering
- 📊 Comprehensive exception details
- ⚙️ Queue support for better performance
- 🧪 Built-in testing tools
- 🎨 Color-coded stack traces
