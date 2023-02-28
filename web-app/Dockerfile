FROM node:18.14-alpine

WORKDIR /app

COPY package*.json ./

RUN npm ci
RUN npm run build

COPY build .

CMD ["npx", "serve", "-s", "build", "-p", "3001"]
