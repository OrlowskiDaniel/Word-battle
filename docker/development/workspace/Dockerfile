FROM php:8.4-cli

ARG UID=1000
ARG GID=1000
ARG NODE_VERSION=22.12.0

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl unzip libpq-dev libonig-dev libzip-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo_pgsql pgsql zip bcmath intl \
    && pecl install redis && docker-php-ext-enable redis \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN if getent group ${GID}; then \
      useradd -m -u ${UID} -g ${GID} -s /bin/bash www; \
    else \
      groupadd -g ${GID} www && useradd -m -u ${UID} -g www -s /bin/bash www; \
    fi && \
    usermod -aG sudo www && \
    echo 'www ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

USER www

# Install NVM + Node
RUN export NVM_DIR="$HOME/.nvm" && \
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.0/install.sh | bash && \
    . "$NVM_DIR/nvm.sh" && \
    nvm install ${NODE_VERSION} && nvm alias default ${NODE_VERSION}

RUN echo 'export NVM_DIR="$HOME/.nvm"' >> ~/.bashrc && \
    echo '[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"' >> ~/.bashrc

# =========================================================================
# NEW: Create global symlinks so 'node' and 'npm' work natively in Docker Exec
# =========================================================================
USER root
RUN ln -s /home/www/.nvm/versions/node/v${NODE_VERSION}/bin/node /usr/local/bin/node && \
    ln -s /home/www/.nvm/versions/node/v${NODE_VERSION}/bin/npm /usr/local/bin/npm && \
    ln -s /home/www/.nvm/versions/node/v${NODE_VERSION}/bin/npx /usr/local/bin/npx

# Switch back to the non-root user
USER www
# =========================================================================

WORKDIR /var/www
ENTRYPOINT []
CMD ["bash"]