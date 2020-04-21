pipeline {
  agent any
  stages {
    stage('Install') {
      steps {
        sh 'composer install'
      }
    }

    stage('Push to Production') {
      steps {
        sh 'rsync -yrzhe "ssh -o StrictHostKeyChecking=no" --exclude vendor/ --exclude mirror/ . jenkins@jop-software.de:/var/www/vhosts/jop-software/often'
      }
    }

    stage('Install Production') {
      steps {
        sh '''ssh jenkins@jop-software.de << EOF
cd /var/www/vhosts/jop-software/often
composer install --no-dev
EOF'''
      }
    }

    stage('Migrate Database') {
      steps {
        sh '''ssh jenkins@jop-software.de << EOF
cd /var/www/vhosts/jop-software/often
./vendor/bin/doctrine-migrations migrate
EOF'''
      }
    }

  }
}